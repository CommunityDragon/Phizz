<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\Definition;
use Phizz\Generator\Interfaces\Writable;

class PhizzGenerator extends Generator
{
    public function definitions(): array
    {
        return [

            //            ...(new RouteGenerator(config: $this->config))->definitions(),
            //            ...(new EnumGenerator(config: $this->config))->definitions(),
            //            ...(new ObjectGenerator(config: $this->config, game: 'riot', api: 'account-v1'))->definitions(),
            ...(new ClientGenerator(config: $this->config))->definitions(),
        ];
    }

    public function generate(): void
    {
        collect($this->definitions())
            ->filter(fn (Definition $definition) => $definition instanceof Writable)
            ->each(fn (Writable $definition) => $definition->write());

        $this->pint();
    }

    protected function pint(?string $path = null): void
    {
        $path ??= __DIR__.'/../../src';
        system(__DIR__."/../../vendor/bin/pint $path");
    }
}
