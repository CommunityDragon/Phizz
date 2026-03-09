<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Constructable;
use Phizz\Support\Helpers;

class GameDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  ApiDefinition[]  $apis
     */
    public function __construct(
        public readonly string $game,
        protected array $apis,
    ) {}

    public function namespace(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);

        return $this->resolveNamespace("Apis\\$game");
    }

    public function directory(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);

        return $this->resolvePath("Apis/$game");
    }

    public function imports(): array
    {
        return [
            $this->resolveNamespace('Enums\\Regional'),
            $this->resolveNamespace('Enums\\Platform'),
            $this->resolveNamespace('Enums\\ValPlatform'),
            ...array_values($this->apiClasses()),
            Constructable::class,
        ];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType($this->className()))
            ->setExtends(Constructable::class);

        $body = collect($this->apiClasses())
            ->map(fn (string $className) => GeneratorHelpers::extractShortName($className))
            ->mapWithKeys(fn (string $className, string $api) => [
                Helpers::formatAttribute(Str::replaceEnd('Api', '', $className), Helpers::CAMEL_CASE) => $className,
            ])
            ->each(fn (string $className, string $api) => $class->addComment("@property $className \$$api"))
            ->each(fn (string $className, string $api) => $class->addComment("@method $className $api(Regional|Platform|ValPlatform|string|null \$platform = null)"))
            ->map(fn (string $className) => new Literal($className.'::class'))
            ->toArray();

        $class->addProperty('constructable', $body)
            ->setType('array')
            ->setProtected();

        return $class;
    }

    public function className(): string
    {
        return $this->namespace().'\\'.Helpers::formatAttribute("$this->game-client", Helpers::PASCAL_CASE);
    }

    /**
     * @return array<string, string>
     */
    public function apiClasses(): array
    {
        return collect($this->apis)
            ->mapWithKeys(fn (ApiDefinition $api) => [
                $api->api => $api->className(),
            ])
            ->toArray();
    }
}
