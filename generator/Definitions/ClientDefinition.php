<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Constructable;
use Phizz\Support\Helpers;

class ClientDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  GameDefinition[]  $games
     */
    public function __construct(protected array $games) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('Apis');
    }

    public function directory(): string
    {
        return $this->resolvePath('Apis');
    }

    public function imports(): array
    {
        return [
            $this->resolveNamespace('Enums\\Regional'),
            $this->resolveNamespace('Enums\\Platform'),
            $this->resolveNamespace('Enums\\ValPlatform'),
            ...array_values($this->gameClasses()),
            Constructable::class,
        ];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType('Client'))
            ->setExtends(Constructable::class);

        $body = collect($this->gameClasses())
            ->mapWithKeys(fn (string $className, string $game) => [
                Helpers::formatAttribute($game, Helpers::CAMEL_CASE) => GeneratorHelpers::extractShortName($className),
            ])
            ->each(fn (string $className, string $game) => $class->addComment("@property $className \$$game"))
            ->each(fn (string $className, string $game) => $class->addComment("@method $className $game(Regional|Platform|ValPlatform|string|null \$platform = null)"))
            ->map(fn (string $className) => new Literal($className.'::class'))
            ->toArray();

        $class->addProperty('constructable', $body)
            ->setType('array')
            ->setProtected();

        return $class;
    }

    /**
     * @return array<string, string>
     */
    public function gameClasses(): array
    {
        return collect($this->games)
            ->mapWithKeys(fn (GameDefinition $game) => [
                $game->game => $game->className(),
            ])
            ->toArray();
    }
}
