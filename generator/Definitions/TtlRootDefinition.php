<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;

class TtlRootDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  TtlGameDefinition[]  $games
     */
    public function __construct(
        public readonly array $games,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('');
    }

    public function directory(): string
    {
        return $this->resolvePath('');
    }

    public function className(): string
    {
        return $this->resolveNamespace('TTL');
    }

    public function imports(): array
    {
        return collect($this->games)
            ->map(fn (TtlGameDefinition $game) => $game->className())
            ->values()
            ->toArray();
    }

    public function definition(): ClassType
    {
        $class = new ClassType('TTL');

        foreach ($this->games as $game) {
            $shortName = Helpers::formatAttribute($game->game, Helpers::PASCAL_CASE).'Ttl';
            $constName = Helpers::formatAttribute($game->game, Helpers::CAMEL_CASE);
            $class->addComment("@property-read class-string<$shortName> \$$constName");
        }

        $class->addMethod('__construct')->setPrivate();

        foreach ($this->games as $game) {
            $constName = Helpers::formatAttribute($game->game, Helpers::CAMEL_CASE);
            $shortName = Helpers::formatAttribute($game->game, Helpers::PASCAL_CASE).'Ttl';
            $class->addConstant($constName, new Literal($shortName.'::class'))->setPublic();
        }

        return $class;
    }
}
