<?php

namespace Phizz\Generator\Generators;

use Exception;
use Phizz\Generator\Definitions\ClientDefinition;
use Phizz\Generator\Definitions\GameDefinition;
use Phizz\Generator\Definitions\ObjectDefinition;
use Phizz\Generator\Definitions\TtlRootDefinition;

class ClientGenerator extends Generator
{
    public function definitions(): array
    {
        /** @var GameDefinition[] $games */
        $games = collect($this->generators())
            ->map(fn (GameGenerator $generator) => $generator->definition())
            ->values()
            ->toArray();

        $ttls = collect($this->generators())
            ->map(fn (GameGenerator $generator) => $generator->ttl())
            ->values()
            ->toArray();

        return [
            ...collect($this->generators())
                ->map(fn (GameGenerator $generator) => $generator->definitions())
                ->values()
                ->flatten()
                ->values()
                ->toArray(),
            new ClientDefinition(games: $games),
            new TtlRootDefinition(games: $ttls),
        ];
    }

    /**
     * @return GameGenerator[]
     */
    public function generators(): array
    {
        return collect($this->config->games)
            ->map(fn (string $game) => new GameGenerator(
                config: $this->config,
                game: $game,
                resolver: fn (string $key) => $this->resolveObject($key)
            ))
            ->values()
            ->toArray();
    }

    /**
     * @throws Exception
     */
    protected function resolveObject(string $key): ObjectDefinition
    {
        foreach ($this->generators() as $gameGenerator) {
            foreach ($gameGenerator->generators() as $apiGenerator) {
                $mapping = $apiGenerator->objectMapping();
                if (array_key_exists($key, $mapping)) {
                    return $mapping[$key];
                }
            }
        }
        throw new Exception("Object definition not found: $key");
    }
}
