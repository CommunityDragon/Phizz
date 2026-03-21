<?php

namespace Phizz\Support;

use Illuminate\Support\Sleep;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * @internal
 */
final class RateLimiter
{
    /**
     * @param  Configuration  $config  Resolved package configuration, used to access the cache store.
     */
    public function __construct(private readonly Configuration $config) {}

    /**
     * Sleeps for the longest exhausted window across app and method rate limit buckets
     * before a request is dispatched, preventing preemptive 429 responses.
     *
     * @param  string  $platform  Resolved routing value (e.g. "na1", "europe").
     * @param  string  $platformType  Class-string of the routing enum used to scope the app bucket.
     * @param  string  $cacheKey  Method TTL constant (e.g. "lol.matchV5.getMatch") used to scope the method bucket.
     *
     * @throws InvalidArgumentException
     */
    public function wait(string $platform, string $platformType, string $cacheKey): void
    {
        $delay = max(
            $this->waitTime($this->appKey($platform, $platformType)),
            $this->waitTime($this->methodKey($platform, $cacheKey)),
        );

        if ($delay > 0) {
            Sleep::for($delay)->seconds();
        }
    }

    /**
     * Parses X-App-Rate-Limit / X-Method-Rate-Limit response headers and persists
     * the current window state to cache so future requests can proactively back off.
     *
     * @param  ResponseInterface  $response  Successful Guzzle response containing rate limit headers.
     * @param  string  $platform  Resolved routing value used to scope the cache key.
     * @param  string  $platformType  Class-string of the routing enum used to scope the app bucket.
     * @param  string  $cacheKey  Method TTL constant used to scope the method bucket.
     */
    public function update(ResponseInterface $response, string $platform, string $platformType, string $cacheKey): void
    {
        $this->storeLimits(
            $this->appKey($platform, $platformType),
            $response->getHeaderLine('X-App-Rate-Limit'),
            $response->getHeaderLine('X-App-Rate-Limit-Count'),
        );

        $this->storeLimits(
            $this->methodKey($platform, $cacheKey),
            $response->getHeaderLine('X-Method-Rate-Limit'),
            $response->getHeaderLine('X-Method-Rate-Limit-Count'),
        );
    }

    /**
     * Parses a limit/count header pair (e.g. "20:1,100:120" / "18:1,99:120") into
     * per-window entries and stores them in cache, keyed by window duration in seconds.
     * TTL is set to the longest window so state persists for the full quota period.
     *
     * @param  string  $key  Cache key under which the window state is stored.
     * @param  string  $limits  X-App-Rate-Limit or X-Method-Rate-Limit header value.
     * @param  string  $counts  X-App-Rate-Limit-Count or X-Method-Rate-Limit-Count header value.
     */
    private function storeLimits(string $key, string $limits, string $counts): void
    {
        if (blank($limits) || blank($counts)) {
            return;
        }

        $limitMap = collect(explode(',', $limits))
            ->mapWithKeys(fn ($pair) => [
                (int) Str::afterLast($pair, ':') => (int) Str::beforeLast($pair, ':'),
            ]);

        $now = microtime(true);

        $windows = collect(explode(',', $counts))
            ->map(fn ($pair) => [
                'count' => (int) Str::beforeLast($pair, ':'),
                'window' => $window = (int) Str::afterLast($pair, ':'),
                'limit' => $limitMap[$window] ?? PHP_INT_MAX,
                'expires_at' => $now + $window,
            ])
            ->keyBy('window')
            ->toArray();

        $this->config->cache->put($key, $windows, max(array_column($windows, 'window')));
    }

    /**
     * Returns the number of seconds to wait for the given rate limit bucket.
     * Finds all exhausted windows (count >= limit, not yet expired) and returns
     * the worst-case remaining time. Returns 0 if no windows are exhausted.
     *
     * @param  string  $key  Cache key identifying the rate limit bucket to check.
     * @return int Seconds to wait; 0 when no back-off is needed.
     *
     * @throws InvalidArgumentException
     */
    private function waitTime(string $key): int
    {
        $now = microtime(true);

        return collect($this->config->cache->get($key, []))
            ->filter(fn ($w) => $w['count'] >= $w['limit'] && $w['expires_at'] > $now)
            ->map(fn ($w) => (int) ceil($w['expires_at'] - $now))
            ->max() ?? 0;
    }

    /**
     * Cache key for application-level rate limits, scoped by platform type and routing value.
     * e.g. phizz.ratelimit.app.Regional.europe
     *
     * @param  string  $platform  Resolved routing value.
     * @param  string  $platformType  Class-string of the routing enum.
     */
    private function appKey(string $platform, string $platformType): string
    {
        return 'phizz.ratelimit.app.'.class_basename($platformType).".$platform";
    }

    /**
     * Cache key for method-level rate limits, scoped by platform and TTL constant.
     * e.g. phizz.ratelimit.method.na1.lol.matchV5.getMatch
     *
     * @param  string  $platform  Resolved routing value.
     * @param  string  $cacheKey  Method TTL constant.
     */
    private function methodKey(string $platform, string $cacheKey): string
    {
        return "phizz.ratelimit.method.$platform.$cacheKey";
    }
}
