<?php

namespace Phizz\Generator\Generators;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\PathItem;
use cebe\openapi\spec\Schema;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Phizz\Generator\Definitions\ApiDefinition;
use Phizz\Generator\Definitions\ObjectDefinition;
use Phizz\Generator\Definitions\TtlDefinition;
use Phizz\Generator\Objects\ApiRoute;
use Phizz\Generator\Objects\Configuration;

class ApiGenerator extends Generator
{
    /**
     * @param  Closure(string): ObjectDefinition  $resolver
     */
    public function __construct(
        Configuration $config,
        protected readonly string $game,
        protected readonly string $api,
        protected readonly Closure $resolver,
    ) {
        parent::__construct($config);
    }

    public function definitions(): array
    {
        return [
            ...array_values($this->objectMapping()),
            $this->definition(),
            $this->ttl(),
        ];
    }

    public function ttl(): TtlDefinition
    {
        return new TtlDefinition(
            game: $this->game,
            api: $this->api,
            routes: $this->routes(),
        );
    }

    public function definition(): ApiDefinition
    {
        return new ApiDefinition(
            game: $this->game,
            api: $this->api,
            routes: $this->routes(),
            resolver: $this->resolver,
        );
    }

    /**
     * @return array<string, ObjectDefinition>
     */
    public function objectMapping(): array
    {
        return collect($this->objects())
            ->map(fn (Schema $component, string $key) => new ObjectDefinition(
                key: $key,
                game: $this->game,
                api: Str::before($key, '.'),
                component: $component,
                resolver: $this->resolver,
            ))
            ->toArray();
    }

    /**
     * @return array<string, Schema>
     */
    protected function objects(): array
    {
        return collect($this->config->schema->components->schemas ?? [])
            ->filter(fn ($_, string $key) => Str::startsWith($key, "$this->api."))
            ->toArray();
    }

    /**
     * @return ApiRoute[]
     */
    protected function routes(): array
    {
        return collect($this->config->schema->paths->getPaths())
            ->filter()
            ->map(fn (PathItem $path) => collect($path->getOperations()))
            ->map(fn (Collection $operations, string $endpoint) => $operations
                ->map(fn (Operation $operation, string $method) => new ApiRoute(
                    endpoint: $endpoint,
                    method: $method,
                    op: $operation,
                ))
                ->flatten()
            )
            ->values()
            ->flatten()
            ->filter(fn (ApiRoute $route) => in_array($this->api, $route->op->tags))
            ->toArray();
    }
}
