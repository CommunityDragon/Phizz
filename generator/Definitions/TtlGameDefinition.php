<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;

class TtlGameDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  TtlDefinition[]  $ttls
     */
    public function __construct(
        public readonly string $game,
        public readonly array $ttls,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('Cache');
    }

    public function directory(): string
    {
        return $this->resolvePath('Cache');
    }

    public function className(): string
    {
        return $this->namespace().'\\'.Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE).'Ttl';
    }

    public function imports(): array
    {
        return collect($this->ttls)
            ->map(fn (TtlDefinition $ttl) => $ttl->className())
            ->values()
            ->toArray();
    }

    public function definition(): ClassType
    {
        $gamePascal = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);

        $class = (new ClassType($gamePascal.'Ttl'))
            ->setFinal(true)
            ->addComment('@internal');

        foreach ($this->ttls as $ttl) {
            $shortName = $ttl->apiName().'Ttl';
            $constName = Helpers::formatAttribute($ttl->apiName(), Helpers::CAMEL_CASE);
            $class->addComment("@property-read class-string<$shortName> \$$constName");
        }

        $class->addMethod('__construct')->setPrivate();

        foreach ($this->ttls as $ttl) {
            $constName = Helpers::formatAttribute($ttl->apiName(), Helpers::CAMEL_CASE);
            $class->addConstant($constName, new Literal($ttl->apiName().'Ttl::class'))->setPublic();
        }

        return $class;
    }
}
