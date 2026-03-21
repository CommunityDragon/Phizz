<?php

namespace Phizz\Support;

/**
 * @internal
 */
final class RequestObject
{
    /**
     * @param  string  $method  HTTP method (GET, POST, PUT, ...).
     * @param  string  $platform  Resolved routing value (e.g. "na1", "europe").
     * @param  string  $platformType  Class-string of the routing enum (Regional, Platform, ValPlatform).
     * @param  string  $endpoint  Endpoint template with {param} placeholders (e.g. /lol/match/v5/matches/{matchId}).
     * @param  array  $pathParams  Map of placeholder name -> value used to resolve $endpoint.
     * @param  array  $queryParams  Raw query parameters; blank values are filtered out by query().
     * @param  string|null  $cacheKey  TTL constant string (e.g. "lol.matchV5.getMatch") used for cache storage and TTL lookup.
     * @param  bool  $returns  Whether the endpoint returns a body; false means the response is discarded.
     * @param  string|null  $returnType  Short class name to instantiate from the response body.
     * @param  string|null  $collectionType  Short class name for each item when the response is a collection.
     * @param  bool  $force  When true, bypasses the cache and always fetches a fresh response.
     */
    public function __construct(
        public readonly string $method,
        public readonly string $platform,
        public readonly string $platformType,
        public readonly string $endpoint,
        public readonly array $pathParams = [],
        protected readonly array $queryParams = [],
        public readonly ?string $cacheKey = null,
        public readonly bool $returns = true,
        public readonly ?string $returnType = null,
        public readonly ?string $collectionType = null,
        public readonly bool $force = false,
    ) {}

    /**
     * Builds the fully-resolved Riot API URL by substituting path params
     * into the endpoint template (e.g. {matchId} -> actual value).
     *
     * @return string Full URL including scheme, platform host, and resolved path.
     */
    public function url(): string
    {
        $endpoint = str_replace(
            array_map(fn ($key) => "{{$key}}", array_keys($this->pathParams)),
            array_values($this->pathParams),
            $this->endpoint,
        );

        return "https://$this->platform.api.riotgames.com$endpoint";
    }

    /**
     * Returns query params with blank values removed.
     *
     * @return array<string, mixed>
     */
    public function query(): array
    {
        return array_filter($this->queryParams, fn ($value) => ! blank($value));
    }

    /**
     * Returns true when the request is eligible for caching (GET only, and not forced fresh).
     */
    public function cacheable(): bool
    {
        return $this->method === 'GET' && ! $this->force;
    }
}
