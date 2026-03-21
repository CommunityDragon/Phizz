<?php

namespace Phizz\Support;

use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;

/**
 * @internal
 */
abstract class Api extends Constructable
{
    /**
     * Resolves the platform, builds a typed RequestObject, and dispatches it through
     * the HTTP client. Named parameters are used by generated API methods.
     *
     * @param  string  $method  HTTP method (e.g. "GET", "POST").
     * @param  string  $endpoint  Endpoint template with {param} placeholders.
     * @param  string  $cacheKey  TTL constant string used for cache and rate limit keying.
     * @param  bool  $returns  Whether the endpoint returns a response body.
     * @param  string  $platformType  Class-string of the expected routing enum.
     * @param  string|null  $returnType  Short class name to instantiate from the response body.
     * @param  string|null  $collectionType  Short class name for each item in a collection response.
     * @param  Regional|Platform|ValPlatform|string|null  $platform  Per-request platform override; falls back to instance then config default.
     * @param  array  $platforms  Optional allow-list of valid routing values for this endpoint.
     * @param  array  $pathParams  Map of placeholder name -> value for endpoint template substitution.
     * @param  array  $query  Raw query parameters; blank values are filtered before dispatch.
     * @param  bool  $force  When true, bypasses the cache and always fetches a fresh response.
     * @return mixed Typed object, collection, raw array, or null.
     *
     * @noinspection PhpDocMissingThrowsInspection
     * @noinspection PhpMissingReturnTypeInspection
     */
    protected function fetch(
        string $method,
        string $endpoint,
        string $cacheKey,
        bool $returns,
        string $platformType,
        ?string $returnType = null,
        ?string $collectionType = null,
        Regional|Platform|ValPlatform|string|null $platform = null,
        array $platforms = [],
        array $pathParams = [],
        array $query = [],
        bool $force = false,
    ) {
        /** @noinspection PhpUnhandledExceptionInspection */
        $platform = Helpers::resolvePlatform(
            platformType: $platformType,
            platform: $platform ?? $this->platform ?? $this->config->platform,
            supportedPlatforms: $platforms,
            endpoint: $endpoint,
        );

        $request = new RequestObject(
            method: $method,
            platform: $platform,
            platformType: $platformType,
            endpoint: $endpoint,
            pathParams: $pathParams,
            queryParams: $query,
            cacheKey: $cacheKey,
            returns: $returns,
            returnType: $returnType,
            collectionType: $collectionType,
            force: $force,
        );

        return $this->client->request($request);
    }
}
