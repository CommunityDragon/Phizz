<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\EnumDefinition;

class EnumGenerator extends Generator
{
    public function definitions(): array
    {
        return collect($this->config->enums)
            ->map(fn (array $items, string $key) => new EnumDefinition(items: $items, key: $key))
            ->values()
            ->toArray();
    }
}
