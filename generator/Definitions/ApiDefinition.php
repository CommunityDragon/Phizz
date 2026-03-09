<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use cebe\openapi\spec\Parameter;
use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Response;
use cebe\openapi\spec\Schema;
use Closure;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Method;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Objects\ApiRoute;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Api;
use Phizz\Support\Helpers;

class ApiDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  ApiRoute[]  $routes
     * @param  Closure(string): ObjectDefinition  $resolver
     */
    public function __construct(
        public readonly string $game,
        public readonly string $api,
        public readonly array $routes,
        public readonly Closure $resolver,
    ) {}

    public function namespace(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = $this->apiName();

        return $this->resolveNamespace("Apis\\$game\\$api");
    }

    public function directory(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = $this->apiName();

        return $this->resolvePath("Apis/$game/$api");
    }

    public function imports(): array
    {
        /** @var Collection<int, Schema|Reference> $schemas */
        $schemas = collect($this->routes)
            ->map(fn (ApiRoute $route) => $route->op->responses->getResponse(200))
            ->map(fn (Response $response) => $response->content['application/json']->schema ?? null)
            ->filter()
            ->values();

        // has collections
        $hasCollections = $schemas
            ->filter(fn ($property) => $property instanceof Schema)
            ->some(fn (Schema $property) => $property->type === 'array');

        // get the collection types
        $collections = $schemas
            ->filter(fn ($property) => $property instanceof Schema)
            ->filter(fn (Schema $property) => $property->type === 'array')
            ->filter(fn (Schema $property) => $property->items instanceof Reference)
            ->values()
            ->map(fn (Schema $property) => $this->resolveReference($property->items->getReference()))
            ->map(fn (ObjectDefinition $definition) => $definition->className());

        // get the reference types
        $references = $schemas
            ->filter(fn ($property) => $property instanceof Reference)
            ->values()
            ->map(fn (Reference $property) => $this->resolveReference($property->getReference()))
            ->map(fn (ObjectDefinition $definition) => $definition->className());

        // merge the imports and get unique values
        $imports = collect([...$collections->toArray(), ...$references->toArray()])
            ->unique()
            ->values();

        // add collection type if collections is not empty
        if ($hasCollections) {
            $imports->add(Collection::class);
        }

        // return the imports
        return [
            Api::class,
            $this->resolveNamespace('Enums\\Regional'),
            $this->resolveNamespace('Enums\\Platform'),
            $this->resolveNamespace('Enums\\ValPlatform'),
            ...$imports->toArray(),
        ];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType($this->className()))
            ->setExtends(Api::class);

        $methods = collect($this->routes)
            ->map(fn (ApiRoute $route) => $this->method($route))
            ->toArray();

        $class->setMethods($methods);

        return $class;
    }

    /**
     * @throws Exception
     */
    protected function method(ApiRoute $route): Method
    {
        $method = new Method(Helpers::formatAttribute(Str::afterLast($route->op->operationId, '.'), Helpers::CAMEL_CASE));

        [$returnType, $collectionType, $returns] = $this->addMethodType($method, $route);
        [$pathParams, $queryParams] = $this->addMethodParameters($method, $route);
        $platformType = $this->addMethodPlatform($method, $route);

        $this->addMethodBody($method, $route, $returns, $platformType, $returnType, $collectionType, $pathParams, $queryParams);

        return $method;
    }

    protected function addMethodParameters(method $method, ApiRoute $route): array
    {
        // add and map the path params
        $pathParams = collect($route->op->parameters)
            ->where('in', 'path')
            ->values()
            ->each(fn (Parameter $param) => $method
                ->addParameter(Helpers::formatAttribute($param->name, Helpers::CAMEL_CASE))
                ->setType($this->resolveType($param->schema))
            )
            ->mapWithKeys(fn (Parameter $param) => [
                $param->name => Helpers::formatAttribute($param->name, Helpers::CAMEL_CASE),
            ])
            ->toArray();

        // add and map the query params
        $queryParams = collect($route->op->parameters)
            ->where('in', 'query')
            ->values()
            ->sortBy('required')
            ->each(function (Parameter $param) use ($method) {
                $parameter = $method
                    ->addParameter(Helpers::formatAttribute($param->name, Helpers::CAMEL_CASE))
                    ->setType($this->resolveType($param->schema))
                    ->setNullable(! $param->required);

                if (! $param->required) {
                    $parameter->setDefaultValue(null);
                }
            })
            ->mapWithKeys(fn (Parameter $param) => [
                $param->name => Helpers::formatAttribute($param->name, Helpers::CAMEL_CASE),
            ])
            ->toArray();

        return [$pathParams, $queryParams];
    }

    /**
     * @throws Exception
     */
    protected function addMethodPlatform(method $method, ApiRoute $route): string
    {
        // add the platform param
        $routeKey = $route->op->getExtensions()['x-route-enum'];
        $platform = match ($routeKey) {
            'regional' => $this->resolveNamespace('Enums\\Regional').'|'.$this->resolveNamespace('Enums\\Platform'),
            'platform' => $this->resolveNamespace('Enums\\Platform'),
            'val-platform' => $this->resolveNamespace('Enums\\ValPlatform'),
            default => throw new Exception('Unsupported platform: '.$route->op->getExtensions()['x-route-enum'])
        };

        $method
            ->addParameter('platform')
            ->setType($platform.'|string')
            ->setDefaultValue(null);

        return Helpers::formatAttribute($routeKey, Helpers::PASCAL_CASE);

    }

    /**
     * @throws array{0: string|null, 1: string|null, 2: bool}
     */
    protected function addMethodType(Method $method, ApiRoute $route): array
    {
        $response = $route->op->responses->getResponse(200);
        $response = $response->content['application/json']->schema ?? null;

        if ($response === null) {
            $method->setReturnType('void');
            $method->addComment('@returns void');

            return [null, null, false];
        }

        if ($response instanceof Reference) {
            $definition = $this->resolveReference($response->getReference());
            $method->setReturnType($definition->className());
            $method->addComment('@returns '.GeneratorHelpers::extractShortName($definition->className()));

            return [GeneratorHelpers::extractShortName($definition->className()), null, true];
        }

        /** @var Schema $response */
        if ($response->type !== 'array') {
            $responseType = $this->resolveType($response);
            $method->setReturnType($responseType);
            $method->addComment("@returns $responseType");

            return [null, null, true];
        }

        if ($response->items instanceof Reference) {
            $definition = $this->resolveReference($response->items->getReference());
            $shortName = GeneratorHelpers::extractShortName($definition->className());
            $method->setReturnType(Collection::class);
            $method->addComment("@returns Collection<int, $shortName>");

            return [null, GeneratorHelpers::extractShortName($definition->className()), true];
        }

        $responseType = $this->resolveType($response->items);
        $method->setReturnType(Collection::class);
        $method->addComment("@returns Collection<int, $responseType>");

        return [GeneratorHelpers::extractShortName(Collection::class), null, true];
    }

    protected function addMethodBody(
        Method $method,
        ApiRoute $route,
        bool $returns,
        string $platformType,
        string|bool|null $returnType,
        ?string $collectionType,
        array $pathParams,
        array $queryParams,
    ): void {
        $httpMethod = Str::upper($route->method);
        $endpoint = Str::replace(['{', '}'], ['$', ''], $route->endpoint);

        $endpoint = Str::replace(array_keys($pathParams), array_values($pathParams), $endpoint);

        $body = "\$this->fetch(\n";
        $body .= "    method: '$httpMethod',\n";
        $body .= "    endpoint: \"$endpoint\",\n";
        $body .= '    returns: '.($returns ? 'true' : 'false').",\n";
        $body .= "    platformType: $platformType::class,\n";

        if (! blank($returnType) && $returnType !== true) {
            $body .= "    returnType: $returnType::class,\n";
        }

        if (! blank($collectionType)) {
            $body .= "    collectionType: $collectionType::class,\n";
        }

        $body .= "    platform: \$platform,\n";

        if (! empty($queryParams)) {
            $body .= "    query: [\n";
            foreach ($queryParams as $name => $value) {
                $body .= "        '$name' => \$$value,\n";
            }
            $body .= "    ],\n";
        }

        if ($returns) {
            $body = "return $body";
        }

        $method->setBody("$body);");
    }

    public function className(): string
    {
        return $this->namespace().'\\'.Helpers::formatAttribute($this->apiName().'Api', Helpers::PASCAL_CASE);
    }

    protected function apiName(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = Helpers::formatAttribute($this->api, Helpers::PASCAL_CASE);

        return Str::replace($game, '', $api);
    }

    protected function resolveReference(string $key): ObjectDefinition
    {
        return ($this->resolver)(Str::replaceStart('#/components/schemas/', '', $key));
    }

    /**
     * Resolves an OpenAPI property to a regular type.
     *
     * @param  Schema  $property  The property schema
     * @return string The PHP type
     */
    protected function resolveType(Schema $property): string
    {
        $type = match ($property->type) {
            'string' => 'string',
            'integer' => 'int',
            'number' => 'float',
            'boolean' => 'bool',
            'array' => 'array',
            'object' => 'array',
            default => 'mixed',
        };

        return $property->nullable ? "$type|null" : $type;
    }
}
