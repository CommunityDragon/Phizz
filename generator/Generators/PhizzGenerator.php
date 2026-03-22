<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\ApiDefinition;
use Phizz\Generator\Definitions\CDragonClientDefinition;
use Phizz\Generator\Definitions\ClientDefinition;
use Phizz\Generator\Definitions\Definition;
use Phizz\Generator\Definitions\EnumDefinition;
use Phizz\Generator\Definitions\GameDefinition;
use Phizz\Generator\Definitions\ObjectDefinition;
use Phizz\Generator\Definitions\RouteDefinition;
use Phizz\Generator\Definitions\StaticDataDefinition;
use Phizz\Generator\Definitions\StaticGameClientDefinition;
use Phizz\Generator\Definitions\TtlDefinition;
use Phizz\Generator\Definitions\TtlGameDefinition;
use Phizz\Generator\Definitions\TtlRootDefinition;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Parsers\CDragonParser;
use Symfony\Component\Filesystem\Filesystem;

class PhizzGenerator extends Generator
{
    public function definitions(): array
    {
        return [
            ...(new RouteGenerator(config: $this->config))->definitions(),
            ...(new EnumGenerator(config: $this->config))->definitions(),
            ...(new ClientGenerator(config: $this->config))->definitions(),
            ...$this->cdragonDefinitions(),
        ];
    }

    public function generate(): void
    {
        $console = $this->config->console;

        $this->wipeCDragon();

        $definitions = collect($this->definitions())
            ->filter(fn (Definition $definition) => $definition instanceof Writable)
            ->values();

        $total = $definitions->count();

        $console->writeln('');
        $console->writeln("  <bg=yellow;fg=black;options=bold>  WRITE  </>  Generating <fg=cyan>{$total}</> files...");

        $currentGroup = null;

        $definitions->each(function (Definition $definition) use ($console, &$currentGroup): void {
            assert($definition instanceof Writable);

            [$groupLabel, $groupColor] = $this->groupFor($definition);

            if ($groupLabel !== $currentGroup) {
                $currentGroup = $groupLabel;
                $dashes = str_repeat('─', max(0, 54 - mb_strlen($groupLabel)));
                $console->writeln('');
                $console->writeln("  <fg={$groupColor};options=bold>  {$groupLabel}  </><fg=gray>{$dashes}</>");
            }

            $name = str_pad($definition->filename(), 44);
            $fullPath = $definition->path();
            $path = (string) preg_replace('|^.*/src/|', 'src/', $fullPath);
            $color = $this->colorFor($definition);

            $definition->write();

            $console->writeln("  <fg=green> ✓ </>  <fg={$color}>{$name}</>  <fg=gray>{$path}</>");
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

    /**
     * @return Definition[]
     */
    private function cdragonDefinitions(): array
    {
        $version = $this->config->cdragonVersion; // 'latest' by default
        $console = $this->config->console;

        $console->writeln('');
        $console->writeln('  <bg=blue;fg=white;options=bold>  INSPECT  </>  Fetching CommunityDragon schema...');
        $console->writeln('');

        $parser = new CDragonParser($version, $console);
        $endpoints = $parser->inspect();

        $console->writeln('');
        $console->writeln('  Found <fg=cyan>'.count($endpoints).'</> endpoints.');

        $dataDefinitions = [];
        $lolEndpoints = [];
        $lolData = [];
        $tftEndpoints = [];
        $tftData = [];

        foreach ($endpoints as $endpoint) {
            $data = new StaticDataDefinition($endpoint);
            $dataDefinitions[] = $data;

            foreach ($data->nestedDefinitions() as $nested) {
                $dataDefinitions[] = $nested;
            }

            if (str_starts_with(strtolower($endpoint->slug), 'tft')) {
                $tftEndpoints[] = $endpoint;
                $tftData[] = $data;
            } else {
                $lolEndpoints[] = $endpoint;
                $lolData[] = $data;
            }
        }

        $lolClientDef = new StaticGameClientDefinition('lol', $lolEndpoints, $lolData);
        $tftClientDef = new StaticGameClientDefinition('tft', $tftEndpoints, $tftData);

        return [...$dataDefinitions, $lolClientDef, $tftClientDef, new CDragonClientDefinition];
    }

    private function wipeCDragon(): void
    {
        $srcPath = __DIR__.'/../../src/CDragon';
        $filesystem = new Filesystem;

        if (! is_dir($srcPath)) {
            return;
        }

        foreach (new \DirectoryIterator($srcPath) as $item) {
            if ($item->isDot() || ! $item->isDir()) {
                continue;
            }
            $filesystem->remove($item->getPathname());
        }

        $filesystem->remove($srcPath.'/CDragonClient.php');
        $filesystem->remove($srcPath.'/LolClient.php');
        $filesystem->remove($srcPath.'/TftClient.php');
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function groupFor(Definition $definition): array
    {
        if ($definition instanceof RouteDefinition || $definition instanceof EnumDefinition) {
            return ['Enums', 'white'];
        }

        if ($definition instanceof TtlDefinition || $definition instanceof TtlGameDefinition) {
            return $this->gameGroup($definition->game);
        }

        if ($definition instanceof GameDefinition) {
            return $this->gameGroup($definition->game);
        }

        if ($definition instanceof ClientDefinition || $definition instanceof TtlRootDefinition) {
            return ['Clients', 'blue'];
        }

        if ($definition instanceof ApiDefinition || $definition instanceof ObjectDefinition) {
            return $this->gameGroup($this->gameFromNamespace($definition->namespace()));
        }

        if ($definition instanceof StaticDataDefinition || $definition instanceof CDragonClientDefinition || $definition instanceof StaticGameClientDefinition) {
            return ['CDragon', 'cyan'];
        }

        return ['Other', 'gray'];
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function gameGroup(string $game): array
    {
        return match ($game) {
            'lol' => ['League of Legends', 'yellow'],
            'tft' => ['Teamfight Tactics', 'blue'],
            'lor' => ['Legends of Runeterra', 'magenta'],
            'val' => ['Valorant', 'red'],
            'riot' => ['Riot', 'white'],
            'riftbound' => ['Riftbound', 'green'],
            default => [ucfirst($game), 'gray'],
        };
    }

    private function gameFromNamespace(string $namespace): string
    {
        return match (true) {
            str_contains($namespace, '\\Lol\\') => 'lol',
            str_contains($namespace, '\\Tft\\') => 'tft',
            str_contains($namespace, '\\Lor\\') => 'lor',
            str_contains($namespace, '\\Val\\') => 'val',
            str_contains($namespace, '\\Riot\\') => 'riot',
            str_contains($namespace, '\\Riftbound\\') => 'riftbound',
            default => 'unknown',
        };
    }

    private function colorFor(Definition $definition): string
    {
        return match (true) {
            $definition instanceof RouteDefinition,
            $definition instanceof EnumDefinition => 'cyan',
            $definition instanceof ApiDefinition => 'yellow',
            $definition instanceof ObjectDefinition => 'white',
            $definition instanceof TtlDefinition,
            $definition instanceof TtlGameDefinition,
            $definition instanceof TtlRootDefinition => 'magenta',
            $definition instanceof GameDefinition,
            $definition instanceof ClientDefinition => 'blue',
            $definition instanceof StaticDataDefinition => 'white',
            $definition instanceof StaticGameClientDefinition,
            $definition instanceof CDragonClientDefinition => 'blue',
            default => 'gray',
        };
    }
}
