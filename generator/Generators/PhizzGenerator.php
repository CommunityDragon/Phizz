<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\Definition;
use Phizz\Generator\Interfaces\Writable;

class PhizzGenerator extends Generator
{
    public function definitions(): array
    {
        return [
            ...(new RouteGenerator(config: $this->config))->definitions(),
            ...(new EnumGenerator(config: $this->config))->definitions(),
            ...(new ClientGenerator(config: $this->config))->definitions(),
            ...(new AssetGenerator(config: $this->config))->definitions(),
        ];
    }

    public function generate(): void
    {
        $console = $this->config->console;

        $definitions = collect($this->definitions())
            ->filter(fn (Definition $definition) => $definition instanceof Writable)
            ->values();

        $total = $definitions->count();

        $console->writeln('');
        $console->writeln("  <bg=yellow;fg=black;options=bold>  WRITE  </>  Generating <fg=cyan>{$total}</> files...");

        $definitions->each(function (Definition $definition) use ($console): void {
            assert($definition instanceof Writable);

            $fullPath = $definition->path();
            $path = (string) preg_replace('|^.*/src/|', 'src/', $fullPath);
            $definition->write();

            $console->writeln("  <fg=green> ✓ </>  $path");
        });

        $console->writeln('');
        $console->writeln('  <bg=cyan;fg=black;options=bold>  FORMAT  </>  Running Laravel Pint...');
        $console->writeln('');

        $this->pint();
    }

    protected function pint(?string $path = null): void
    {
        $path ??= __DIR__.'/../../src';
        system(__DIR__."/../../vendor/bin/pint $path");
    }
}
