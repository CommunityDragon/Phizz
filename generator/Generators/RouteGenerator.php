<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\RouteDefinition;

class RouteGenerator extends Generator
{
    public function definitions(): array
    {
        return collect($this->config->routes)
            ->map(fn (array $items, string $key) => new RouteDefinition(key: $key, items: $items))
            ->values()
            ->toArray();
    }
}
