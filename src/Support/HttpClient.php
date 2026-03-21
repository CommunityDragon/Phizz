<?php

namespace Phizz\Support;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Sleep;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
class HttpClient
{
    /**
     * Underlying Guzzle HTTP client instance.
     */
    private readonly Guzzle $guzzle;

    /**
     * Proactive rate limit tracker backed by the cache store.
     */
    private readonly RateLimiter $rateLimiter;

    /**
     * @param  Configuration  $config  Resolved package configuration.
     * @param  Cache  $cache  Response cache wrapper.
     * @param  Guzzle|null  $guzzle  Optional Guzzle client instance; a default client is created when null.
     */
    public function __construct(
        private readonly Configuration $config,
        private readonly Cache $cache,
        ?Guzzle $guzzle = null,
    ) {
        $this->guzzle = $guzzle ?? new Guzzle;
        $this->rateLimiter = new RateLimiter($config);
    }

    /**
     * Dispatches a request, serving GET responses from cache on hits.
     * Resolves the response body into the requested return type via Helpers::resolveBody().
     *
     * @param  RequestObject  $request  Fully-populated request descriptor.
     * @return mixed Typed object, collection, raw array, or null.
     */
    public function request(RequestObject $request): mixed
    {
        $url = $request->url();
        $query = $request->query();

        $send = fn () => $this->send(
            $request->method,
            $url,
            $query,
            $request->platform,
            $request->platformType,
            $request->cacheKey,
        );

        $body = $request->cacheable()
            ? $this->cache->remember(
                platform: $request->platform,
                cacheKey: $request->cacheKey,
                pathParams: $request->pathParams,
                queryParams: $query,
                callback: $send,
            )
            : $send();

        return Helpers::resolveBody(
            body: $body,
            returns: $request->returns,
            returnType: $request->returnType,
            collectionType: $request->collectionType,
        );
    }

    /**
     * Executes the HTTP request with proactive rate limit checks, a dynamic per-attempt
     * timeout, and retry on 429 responses within the configured timeout window.
     * Rate limit state is updated from response headers after each successful call.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully-resolved request URL.
     * @param  array  $query  Filtered query parameters.
     * @param  string  $platform  Resolved routing value passed to the rate limiter.
     * @param  string  $platformType  Class-string of the routing enum passed to the rate limiter.
     * @param  string  $cacheKey  Method TTL constant passed to the rate limiter.
     * @return mixed Decoded JSON response body.
     *
     * @noinspection PhpDocMissingThrowsInspection
     */
    private function send(
        string $method,
        string $url,
        array $query,
        string $platform,
        string $platformType,
        string $cacheKey,
    ): mixed {
        $start = microtime(true);
        $attempt = 0;

        while (true) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $this->rateLimiter->wait($platform, $platformType, $cacheKey);

            $remaining = $this->config->timeout - (microtime(true) - $start);

            try {
                /** @noinspection PhpUnhandledExceptionInspection */
                $res = $this->guzzle->request($method, $url, [
                    'query' => $query,
                    'headers' => ['X-Riot-Token' => $this->config->apiKey],
                    'timeout' => $remaining,
                ]);

                $this->rateLimiter->update($res, $platform, $platformType, $cacheKey);

                return json_decode($res->getBody(), true);
            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() !== 429 || (microtime(true) - $start) >= $this->config->timeout) {
                    throw $e;
                }

                Sleep::for($this->retryDelay($e->getResponse(), $attempt))->seconds();

                $attempt++;
            }
        }
    }

    /**
     * Returns the delay in seconds before the next retry attempt.
     * Uses Retry-After from the response when present (set by the API edge infrastructure).
     * Falls back to the configured retry strategy when absent, which indicates the
     * 429 originated from an underlying service (no X-Rate-Limit-Type header).
     *
     * @param  ResponseInterface  $response  The 429 response containing rate limit headers.
     * @param  int  $attempt  Zero-based retry attempt count used by the strategy.
     * @return int Seconds to wait before retrying.
     */
    private function retryDelay(ResponseInterface $response, int $attempt): int
    {
        $retryAfter = (int) $response->getHeaderLine('Retry-After');

        if ($retryAfter > 0) {
            return $retryAfter;
        }

        return $this->config->retryStrategy->delay($attempt);
    }
}
