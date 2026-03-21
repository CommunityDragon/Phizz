<?php

namespace Phizz\Support;

use Closure;

/**
 * @internal
 */
final class Cache
{
    /**
     * @param  Configuration  $config  Resolved package configuration, used to access the cache store and TTL settings.
     */
    public function __construct(private readonly Configuration $config) {}

    /**
     * Returns a cached value if present, otherwise invokes the callback, stores the result,
     * and returns it. Bypasses the cache entirely when caching is disabled in config.
     *
     * @param  string  $platform  Resolved routing value, included in the cache key.
     * @param  string  $cacheKey  Method TTL constant used for key construction and TTL lookup.
     * @param  array  $pathParams  Path parameters included in the cache key hash.
     * @param  array  $queryParams  Query parameters included in the cache key hash.
     * @param  Closure  $callback  Invoked on cache miss; its return value is stored and returned.
     * @return mixed Cached or freshly fetched response body.
     */
    public function remember(
        string $platform,
        string $cacheKey,
        array $pathParams,
        array $queryParams,
        Closure $callback,
    ): mixed {
        if (! $this->config->cacheResponses) {
            return $callback();
        }

        $key = $this->key($platform, $cacheKey, $pathParams, $queryParams);

        $cached = $this->get($key);

        if ($cached !== null) {
            return $cached;
        }

        $value = $callback();

        $this->put($key, $value, $this->ttl($cacheKey));

        return $value;
    }

    /**
     * Retrieves a value from the underlying cache store.
     *
     * @param  string  $key  Cache storage key.
     * @return mixed Stored value, or null if the key does not exist or has expired.
     *
     * @noinspection PhpDocMissingThrowsInspection
     */
    private function get(string $key): mixed
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return $this->config->cache->get($key);
    }

    /**
     * Stores a value in the underlying cache store with the given TTL in seconds.
     *
     * @param  string  $key  Cache storage key.
     * @param  mixed  $value  Value to store.
     * @param  int  $ttl  Time-to-live in seconds.
     */
    private function put(string $key, mixed $value, int $ttl): void
    {
        $this->config->cache->put($key, $value, $ttl);
    }

    /**
     * Resolves the TTL for a given cache key by checking per-method overrides first,
     * then falling back to the configured default TTL.
     *
     * @param  string  $cacheKey  Method TTL constant (e.g. "lol.matchV5.getMatch").
     * @return int TTL in seconds.
     */
    private function ttl(string $cacheKey): int
    {
        return $this->config->methodTTLs[$cacheKey] ?? $this->config->ttl;
    }

    /**
     * Builds a deterministic, human-readable cache storage key from the platform,
     * method cache key, and an MD5 of the sorted path and query params.
     * e.g. phizz.cache.na1.lol.matchV5.getMatch.<hash>
     *
     * @param  string  $platform  Resolved routing value.
     * @param  string  $cacheKey  Method TTL constant.
     * @param  array  $pathParams  Path parameters (sorted before hashing).
     * @param  array  $queryParams  Query parameters (sorted before hashing).
     * @return string Fully-qualified cache storage key.
     */
    private function key(string $platform, string $cacheKey, array $pathParams, array $queryParams): string
    {
        ksort($pathParams);
        ksort($queryParams);
        $hash = md5(serialize($pathParams).serialize($queryParams));

        return "phizz.cache.$platform.$cacheKey.$hash";
    }
}
