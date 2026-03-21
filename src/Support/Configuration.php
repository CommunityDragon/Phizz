<?php

namespace Phizz\Support;

use Illuminate\Contracts\Cache\Repository as CacheContract;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Retry;

/**
 * @internal
 */
final class Configuration
{
    /**
     * Riot Games API key sent as the X-Riot-Token request header.
     */
    public readonly string $apiKey;

    /**
     * Default routing platform used when no per-request platform is specified.
     */
    public readonly Regional|Platform|ValPlatform|string|null $platform;

    /**
     * Maximum total wall-clock seconds allowed for a single request, including retries.
     */
    public readonly int $timeout;

    /**
     * Whether response caching is enabled.
     */
    public readonly bool $cacheResponses;

    /**
     * Default cache TTL in seconds applied when no per-method override exists.
     */
    public readonly int $ttl;

    /**
     * Underlying Laravel cache store used for response and rate-limit storage.
     */
    public readonly CacheContract $cache;

    /**
     * Retry strategy that determines the back-off delay between attempts.
     */
    public readonly Retry $retryStrategy;

    /**
     * Per-method TTL overrides keyed by TTL constant (e.g. "lol.matchV5.getMatch" => 300).
     *
     * @var array<string, int>
     */
    public readonly array $methodTTLs;

    /**
     * Resolves and freezes all package configuration values from the Laravel config
     * repository into strongly-typed readonly properties for use across the package.
     *
     * @param  ConfigContract  $config  Laravel config repository bound to the phizz namespace.
     * @param  CacheContract  $cache  Cache store used for response caching and rate limit state.
     */
    public function __construct(ConfigContract $config, CacheContract $cache)
    {
        $this->apiKey = $config->get('phizz.api_key', '');
        $this->platform = $config->get('phizz.default_platform');
        $this->timeout = (int) $config->get('phizz.timeout', 60);
        $this->cacheResponses = (bool) $config->get('phizz.cache.enabled', false);
        $this->ttl = (int) $config->get('phizz.cache.default', 60);
        $this->cache = $cache;
        $this->retryStrategy = $config->get('phizz.retry.strategy', Retry::exponential());
        $this->methodTTLs = $config->get('phizz.cache.method', []);
    }
}
