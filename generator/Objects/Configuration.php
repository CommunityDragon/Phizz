<?php

namespace Phizz\Generator\Objects;

use cebe\openapi\spec\OpenApi;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;

class Configuration
{
    /**
     * @var string[]
     */
    public readonly array $games;

    /**
     * @param  array<string, array>  $routes
     * @param  array<string, array>  $enums
     */
    public function __construct(
        public readonly OutputInterface $console,
        public readonly OpenApi $schema,
        public readonly array $routes,
        public readonly array $enums
    ) {
        $this->games = $this->resolveGames();
    }

    /**
     * @return string[]
     */
    protected function resolveGames(): array
    {
        return collect($this->schema->paths->getPaths())
            ->keys()
            ->map(fn ($endpoint) => Str::replaceStart('/', '', $endpoint))
            ->map(fn ($endpoint) => Str::before($endpoint, '/'))
            ->unique()
            ->values()
            ->toArray();
    }
}
