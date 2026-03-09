<?php

namespace Phizz\Support;

use GuzzleHttp\Client as Guzzle;
use InvalidArgumentException;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;

abstract class Constructable
{
    /**
     * @var array<string, class-string<Constructable>>
     */
    protected array $constructable = [];

    /**
     * @var array<string, Constructable>
     */
    private array $instances = [];

    public function __construct(
        protected readonly Configuration $config,
        protected readonly Guzzle $client,
        protected readonly Regional|ValPlatform|Platform|string|null $platform = null
    ) {}

    /**
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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

    private function createClient(string $name, Regional|ValPlatform|Platform|string|null $platform)
    {
        $class = $this->constructable[$name];
        $platform = $platform ?? $this->platform;

        return new $class($this->config, $this->client, $platform);
    }
}
