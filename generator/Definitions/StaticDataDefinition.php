<?php

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Literal;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Objects\CDragonEndpoint;
use Phizz\Generator\Objects\CDragonField;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;
use Phizz\Support\StaticData;

/**
 * Generates a typed Data class for a CommunityDragon JSON endpoint.
 * Child objects become their own typed class; child arrays become Collections.
 * Path fields become URL accessor methods.
 *
 * @extends Definition<ClassType>
 */
class StaticDataDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * @param  string|null  $parentSlug  When set, namespace/directory are scoped to the parent endpoint.
     * @param  string|null  $fieldName  When set, overrides class name derivation (used for nested definitions).
     * @param  string  $classPrefix  Prepended to the short class name to avoid collisions in deep nesting.
     * @param  bool  $singularize  When true, singularizes the field name for the class name (used for list fields).
     */
    public function __construct(
        private readonly CDragonEndpoint $endpoint,
        private readonly ?string $parentSlug = null,
        private readonly ?string $fieldName = null,
        private readonly string $classPrefix = '',
        private readonly bool $singularize = false,
    ) {}

    public function namespace(): string
    {
        $slug = $this->parentSlug ?? $this->endpoint->slug;

        return $this->resolveNamespace('CDragon\\'.Str::studly($slug).'\\Objects');
    }

    public function directory(): string
    {
        $slug = $this->parentSlug ?? $this->endpoint->slug;

        return $this->resolvePath('CDragon/'.Str::studly($slug).'/Objects');
    }

    public function imports(): array
    {
        $imports = [StaticData::class];
        $hasCollections = false;

        foreach ($this->endpoint->fields as $field) {
            if ($field->isObject && $this->shouldGenerateNested($field, false)) {
                $imports[] = $this->nestedFqcn($field->name, false);
            } elseif ($field->isList && $this->shouldGenerateNested($field, true)) {
                $imports[] = $this->nestedFqcn($field->name, true);
                $hasCollections = true;
            }
        }

        if ($hasCollections) {
            $imports[] = Collection::class;
        }

        return array_unique($imports);
    }

    public function definition(): ClassType
    {
        $class = (new ClassType($this->shortClassName()))
            ->setExtends(StaticData::class);

        $objects = [];
        $collections = [];

        foreach ($this->endpoint->fields as $field) {
            if ($field->isObject && $this->shouldGenerateNested($field, false)) {
                $snakeKey = Helpers::formatAttribute($field->name);
                $camelProp = Helpers::formatAttribute($field->name, Helpers::CAMEL_CASE);
                $shortName = GeneratorHelpers::extractShortName($this->nestedFqcn($field->name, false));
                $class->addComment('@property-read '.$shortName.' $'.$camelProp);
                $objects[$snakeKey] = new Literal($shortName);
            } elseif ($field->isList && $this->shouldGenerateNested($field, true)) {
                $snakeKey = Helpers::formatAttribute($field->name);
                $camelProp = Helpers::formatAttribute($field->name, Helpers::CAMEL_CASE);
                $shortName = GeneratorHelpers::extractShortName($this->nestedFqcn($field->name, true));
                $class->addComment('@property-read Collection<int, '.$shortName.'> $'.$camelProp);
                $collections[$snakeKey] = new Literal($shortName);
            } elseif ($field->isPath) {
                if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $field->name)) {
                    $snakeProp = Helpers::formatAttribute($field->name);
                    $class->addComment('@property-read string $'.$snakeProp);
                    $methodName = Str::replaceLast('Path', 'Url', $field->name);
                    $method = $class->addMethod($methodName)->setReturnType('string');
                    $method->setBody('return $this->toUrl($this->'.$snakeProp.');');
                }
            } elseif (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $field->name)) {
                $snakeProp = Helpers::formatAttribute($field->name);
                $class->addComment('@property-read '.$this->propertyType($field).' $'.$snakeProp);
            }
        }

        if (! empty($objects)) {
            $class->addProperty('objects', $this->dumpArray($objects))
                ->setType('array')
                ->setProtected();
        }

        if (! empty($collections)) {
            $class->addProperty('collections', $this->dumpArray($collections))
                ->setType('array')
                ->setProtected();
        }

        return $class;
    }

    public function className(): string
    {
        return $this->namespace().'\\'.$this->shortClassName();
    }

    /**
     * Returns CDragonDataDefinition objects for all fields that are objects or lists-of-objects.
     * Recurses into nested definitions so deeply nested types are included.
     *
     * @return StaticDataDefinition[]
     */
    public function nestedDefinitions(): array
    {
        $nested = [];
        $parentSlug = $this->parentSlug ?? $this->endpoint->slug;

        foreach ($this->endpoint->fields as $field) {
            if (empty($field->subFields)) {
                continue;
            }

            $singularize = $field->isList && ! $field->isObject;

            if (! $this->shouldGenerateNested($field, $singularize)) {
                continue;
            }

            $subEndpoint = new CDragonEndpoint(
                file: $field->name,
                slug: $field->name,
                isArray: $field->isList,
                idField: null,
                fields: $field->subFields,
            );

            $def = new StaticDataDefinition($subEndpoint, $parentSlug, $field->name, $this->childClassPrefix(), $singularize);
            $nested[] = $def;

            foreach ($def->nestedDefinitions() as $deepNested) {
                $nested[] = $deepNested;
            }
        }

        return $nested;
    }

    private function shortClassName(): string
    {
        if ($this->fieldName !== null) {
            $base = $this->singularize
                ? Str::studly(Str::singular($this->fieldName))
                : Str::studly($this->fieldName);

            return $this->classPrefix.$base.'Data';
        }

        return Str::studly(Str::singular($this->endpoint->slug)).'Data';
    }

    /**
     * Computes the class prefix to pass to child nested definitions.
     * Top-level endpoints pass '' so first-level children stay unprefixed.
     * Deeper levels accumulate the parent stem to prevent name collisions.
     */
    private function childClassPrefix(): string
    {
        if ($this->fieldName === null) {
            return '';
        }

        $base = $this->singularize
            ? Str::studly(Str::singular($this->fieldName))
            : Str::studly($this->fieldName);

        return $this->classPrefix.$base;
    }

    /**
     * Returns true when a nested typed class should be generated for this field:
     * - The field has sub-fields (otherwise there's nothing to type)
     * - The derived class name is a valid PHP identifier (no numeric/UUID-keyed maps)
     * - The nested class name would not collide with this class's own name
     */
    private function shouldGenerateNested(CDragonField $field, bool $singularize): bool
    {
        if (empty($field->subFields)) {
            return false;
        }

        $cn = $singularize
            ? Str::studly(Str::singular($field->name))
            : Str::studly($field->name);

        if (! preg_match('/^[a-zA-Z_]/', $cn)) {
            return false;
        }

        return $this->nestedFqcn($field->name, $singularize) !== $this->className();
    }

    private function nestedFqcn(string $fieldName, bool $singularize): string
    {
        $slug = $this->parentSlug ?? $this->endpoint->slug;
        $ns = $this->resolveNamespace('CDragon\\'.Str::studly($slug).'\\Objects');
        $base = $singularize ? Str::studly(Str::singular($fieldName)) : Str::studly($fieldName);
        $cn = $this->childClassPrefix().$base.'Data';

        return $ns.'\\'.$cn;
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

    private function propertyType(CDragonField $field): string
    {
        if ($field->isList) {
            return 'array';
        }

        $type = $field->phpType;

        return $field->nullable ? "{$type}|null" : $type;
    }
}
