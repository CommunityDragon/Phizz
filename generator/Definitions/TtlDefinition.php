<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Objects\ApiRoute;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;

class TtlDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  ApiRoute[]  $routes
     */
    public function __construct(
        public readonly string $game,
        public readonly string $api,
        public readonly array $routes,
    ) {}

    public function namespace(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);

        return $this->resolveNamespace("Cache\\$game");
    }

    public function directory(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);

        return $this->resolvePath("Cache/$game");
    }

    public function className(): string
    {
        return $this->namespace().'\\'.$this->apiName().'Ttl';
    }

    public function apiName(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = Helpers::formatAttribute($this->api, Helpers::PASCAL_CASE);

        return Str::replace($game, '', $api);
    }

    public function definition(): ClassType
    {
        $class = (new ClassType($this->apiName().'Ttl'))
            ->setFinal(true)
            ->addComment('@internal');

        $class->addMethod('__construct')->setPrivate();

        $apiCamel = Helpers::formatAttribute($this->apiName(), Helpers::CAMEL_CASE);

        foreach ($this->routes as $route) {
            $methodName = Helpers::formatAttribute(
                Str::afterLast($route->op->operationId, '.'),
                Helpers::CAMEL_CASE
            );

            $class->addConstant($methodName, "$this->game.$apiCamel.$methodName")->setPublic();
        }

        return $class;
    }
}
