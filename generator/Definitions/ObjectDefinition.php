<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use cebe\openapi\spec\Reference;
use cebe\openapi\spec\Schema;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Data;
use Phizz\Support\Helpers;

class ObjectDefinition extends Definition implements Writable
{
    use HasWrite;

    protected Dumper $dumper;

    /**
     * @param  Closure(string): $this  $resolver
     */
    public function __construct(
        public readonly string $key,
        protected readonly string $game,
        protected readonly string $api,
        protected readonly Schema $component,
        protected readonly Closure $resolver,
    ) {
        $this->dumper = new Dumper;
    }

    public function namespace(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = Helpers::formatAttribute($this->api, Helpers::PASCAL_CASE);
        $api = Str::replace($game, '', $api);

        return $this->resolveNamespace("Apis\\$game\\$api\\Objects");
    }

    public function directory(): string
    {
        $game = Helpers::formatAttribute($this->game, Helpers::PASCAL_CASE);
        $api = Helpers::formatAttribute($this->api, Helpers::PASCAL_CASE);
        $api = Str::replace($game, '', $api);

        return $this->resolvePath("Apis/$game/$api/Objects");
    }

    public function imports(): array
    {
        // has collections
        $hasCollections = collect($this->component->properties)
            ->filter(fn ($property) => $property instanceof Schema)
            ->some(fn (Schema $property) => $property->type === 'array');

        // get the collection types
        $collections = collect($this->component->properties)
            ->filter(fn ($property) => $property instanceof Schema)
            ->filter(fn (Schema $property) => $property->type === 'array')
            ->filter(fn (Schema $property) => $property->items instanceof Reference)
            ->values()
            ->map(fn (Schema $property) => $this->resolveReference($property->items->getReference()))
            ->map(fn (ObjectDefinition $definition) => $definition->className());

        // get the reference types
        $references = collect($this->component->properties)
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
        return [Data::class, ...$imports->toArray()];
    }

    public function definition(): ClassType
    {
        $class = (new ClassType($this->className()))
            ->setExtends(Data::class);

        $this->addProperties($class);
        $this->addCollections($class);
        $this->addObjects($class);

        return $class;
    }

    public function className(): string
    {
        $name = Str::replaceStart("$this->api.", '', $this->component->title);
        $name = Str::replaceMatches('/(DTO|Dto)$/', '', $name);
        $name = Helpers::formatAttribute($name.'Data', Helpers::PASCAL_CASE);

        return $this->namespace().'\\'.$name;
    }

    public function description(): ?string
    {
        return $this->component->description ?? null;
    }

    protected function addProperties(ClassType $class): void
    {
        collect($this->component->properties)
            ->filter(fn ($property) => $property instanceof Schema)
            ->filter(fn ($property) => $property->type !== 'array')
            ->each(fn ($property, $attribute) => $this->addProperty($class, $attribute, $property));
    }

    protected function addProperty(ClassType $class, string $attribute, Schema $property): void
    {
        $attribute = Helpers::formatAttribute($attribute);
        $type = $this->propertyType($property);
        $class->addComment("@property-read $type \$$attribute $property->description");
    }

    protected function addCollections(ClassType $class): void
    {
        $collections = collect($this->component->properties)
            ->filter(fn ($property) => $property instanceof Schema)
            ->filter(fn (Schema $property) => $property->type === 'array')
            ->filter(fn (Schema $property) => ! empty($property->items))
            ->map(fn (Schema $property, string $attribute) => $this->addCollection($class, $attribute, $property))
            ->reduce(fn (array $acc, array $items) => $acc + $items, []);

        if (empty($collections)) {
            return;
        }

        $class->addProperty('collections', $this->dumpArray($collections))
            ->setType('array')
            ->setProtected();
    }

    protected function addCollection(ClassType $class, string $attribute, Schema|Reference $property): array
    {
        $variable = Helpers::formatAttribute($attribute, Helpers::CAMEL_CASE);
        $attribute = Helpers::formatAttribute($attribute);

        if ($property->items instanceof Reference) {
            $definition = $this->resolveReference($property->items->getReference());
            $className = GeneratorHelpers::extractShortName($definition->className());
            $class->addComment("@property-read Collection<int, $className> \$$variable $property->description");

            return [$attribute => new Literal($className)];
        }

        $type = $this->propertyType($property->items);
        $class->addComment("@property-read Collection<int, $type> \$$variable $property->description");

        return [$attribute];
    }

    protected function addObjects(ClassType $class): void
    {
        $objects = collect($this->component->properties)
            ->filter(fn ($property) => $property instanceof Reference)
            ->map(fn (Reference $property, string $attribute) => $this->addObject($class, $attribute, $property))
            ->reduce(fn (array $acc, array $items) => $acc + $items, []);

        if (empty($objects)) {
            return;
        }

        $class->addProperty('objects', $this->dumpArray($objects))
            ->setType('array')
            ->setProtected();
    }

    protected function addObject(ClassType $class, string $attribute, Schema|Reference $property): array
    {
        $variable = Helpers::formatAttribute($attribute, Helpers::CAMEL_CASE);
        $attribute = Helpers::formatAttribute($attribute);

        $definition = $this->resolveReference($property->getReference());
        $description = $property->description ?? $definition->description() ?? '';
        $className = GeneratorHelpers::extractShortName($definition->className());
        $class->addComment("@property-read $className \$$variable $description");

        return [$attribute => new Literal($className)];
    }

    protected function resolveReference(string $key): ObjectDefinition
    {
        return ($this->resolver)(Str::replaceStart('#/components/schemas/', '', $key));
    }

    private function dumpArray(array $array): Literal
    {
        $body = '';

        foreach ($array as $key => $value) {
            $body .= '    ';
            $body .= gettype($key) === 'integer' ? "'$value'" : "'$key' => $value::class";
            $body .= ",\n";
        }

        return new Literal("[\n$body]");
    }

    /**
     * Resolves an OpenAPI property to a regular type.
     *
     * @param  Schema  $property  The property schema
     * @return string The PHP type
     */
    private function propertyType(Schema $property): string
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
