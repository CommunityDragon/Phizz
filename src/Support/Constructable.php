<?php

namespace Phizz\Support;

use InvalidArgumentException;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;

/**
 * @internal
 */
abstract class Constructable
{
    /**
     * Map of property/method name to the child client class that should be instantiated.
     *
     * @var array<string, class-string<Constructable>>
     */
    protected array $constructable = [];

    /**
     * Cached child client instances, keyed by the name used to access them.
     *
     * @var array<string, Constructable>
     */
    private array $instances = [];

    /**
     * @param  Configuration  $config  Resolved package configuration.
     * @param  HttpClient  $client  Shared HTTP client instance.
     * @param  Regional|ValPlatform|Platform|string|null  $platform  Optional default platform override for this client.
     */
    public function __construct(
        protected readonly Configuration $config,
        protected readonly HttpClient $client,
        protected readonly Regional|ValPlatform|Platform|string|null $platform = null
    ) {}

    /**
     * Returns a lazily-instantiated child client by property name.
     * The instance is cached on first access so subsequent reads are free.
     *
     * @param  string  $name  Property name matching a key in $constructable.
     * @return object Child client instance.
     *
     * @throws InvalidArgumentException If $name is not registered in $constructable.
     */
    public function __get(string $name): object
    {
        if (! isset($this->constructable[$name])) {
            throw new InvalidArgumentException("Property [$name] is not available.");
        }

        if (! isset($this->instances[$name])) {
            $this->instances[$name] = $this->createClient($name, null);
        }

        return $this->instances[$name];
    }

    /**
     * Returns a child client by method name, optionally scoped to a specific platform.
     * When no platform argument is provided the call delegates to __get() and returns
     * the cached default-platform instance.
     *
     * @param  string  $name  Method name matching a key in $constructable.
     * @param  array  $arguments  Optional first element is a platform override value.
     * @return object Child client instance scoped to the given platform.
     *
     * @throws InvalidArgumentException If $name is not registered in $constructable.
     */
    public function __call(string $name, array $arguments): object
    {
        if (! isset($this->constructable[$name])) {
            throw new InvalidArgumentException("Method [$name] is not available.");
        }

        $platform = $arguments[0] ?? null;

        if ($platform === null) {
            return $this->__get($name);
        }

        return $this->createClient($name, $platform);
    }

    /**
     * Instantiates a child client class from $constructable, inheriting the current
     * platform when no override is provided.
     *
     * @param  string  $name  Key in $constructable identifying the class to instantiate.
     * @param  Regional|ValPlatform|Platform|string|null  $platform  Platform override; falls back to $this->platform when null.
     * @return Constructable Newly created child client instance.
     */
    private function createClient(string $name, Regional|ValPlatform|Platform|string|null $platform): Constructable
    {
        $class = $this->constructable[$name];
        $platform = $platform ?? $this->platform;

        return new $class($this->config, $this->client, $platform);
    }
}
