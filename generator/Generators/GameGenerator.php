<?php

namespace Phizz\Generator\Generators;

use cebe\openapi\spec\Operation;
use cebe\openapi\spec\PathItem;
use Closure;
use Phizz\Generator\Definitions\ApiDefinition;
use Phizz\Generator\Definitions\GameDefinition;
use Phizz\Generator\Definitions\ObjectDefinition;
use Phizz\Generator\Definitions\TtlGameDefinition;
use Phizz\Generator\Objects\Configuration;

class GameGenerator extends Generator
{
    /**
     * @param  Closure(string): ObjectDefinition  $resolver
     */
    public function __construct(
        Configuration $config,
        protected readonly string $game,
        protected readonly Closure $resolver,
    ) {
        parent::__construct($config);
    }

    public function definitions(): array
    {
        return [
            ...collect($this->generators())
                ->map(fn (ApiGenerator $generator) => $generator->definitions())
                ->values()
                ->flatten()
                ->values()
                ->toArray(),
            $this->definition(),
            $this->ttl(),
        ];
    }

    public function ttl(): TtlGameDefinition
    {
        $ttls = collect($this->generators())
            ->map(fn (ApiGenerator $generator) => $generator->ttl())
            ->values()
            ->toArray();

        return new TtlGameDefinition(game: $this->game, ttls: $ttls);
    }

    public function definition(): GameDefinition
    {
        /** @var ApiDefinition[] $apis */
        $apis = collect($this->generators())
            ->map(fn (ApiGenerator $generator) => $generator->definition())
            ->values()
            ->toArray();

        return new GameDefinition(game: $this->game, apis: $apis);
    }

    /**
     * @return ApiGenerator[]
     */
    public function generators(): array
    {
        return collect($this->apis())
            ->map(fn (string $api) => new ApiGenerator(
                config: $this->config,
                game: $this->game,
                api: $api,
                resolver: $this->resolver
            ))
            ->values()
            ->toArray();
    }

    /**
     * @return string[]
     */
    protected function apis(): array
    {
        return collect($this->config->schema->paths->getPaths())
            ->filter()
            ->map(fn (PathItem $path) => $path->getOperations())
            ->filter(fn ($_, string $endpoint) => $this->endpointIsValid($endpoint))
            ->map(fn (array $operations) => collect($operations))
            ->values()
            ->flatten()
            ->map(fn (Operation $operation) => $operation->tags)
            ->flatten()
            ->unique()
            ->values()
            ->toArray();
    }

    private function endpointIsValid(string $endpoint): bool
    {
        $parts = explode('/', $endpoint);

        $result = null;
        $position = -1;

        foreach ($this->config->games as $game) {
            /** @phpstan-ignore greater.alwaysTrue */
            if (($search = array_search($game, $parts)) !== false && $search > $position) {
                $result = $game;
            }
        }

        return $result === $this->game;
    }
}
