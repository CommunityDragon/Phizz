<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Str;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\EnumCase;
use Nette\PhpGenerator\EnumType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Nette\PhpGenerator\Method;
use Nette\Utils\Type;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;

/**
 * @extends Definition<EnumType>
 */
class RouteDefinition extends Definition implements Writable
{
    use HasWrite;

    public const UPPERCASED = [
        'platform',
        'val-platform',
    ];

    public const OVERRIDES = [
        'esports' => 'Esports',
        'esportseu' => 'EsportsEU',
        'latam' => 'LatAm',
        'apac' => 'APAC',
        'sea' => 'SEA',
    ];

    public const EXCLUDED_METHOD_KEYS = [
        'altName',
    ];

    /**
     * @param  array<string, array<string, mixed>>  $items
     */
    public function __construct(
        protected readonly string $key,
        protected readonly array $items,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('Enums');
    }

    public function directory(): string
    {
        return $this->resolvePath('Enums');
    }

    public function definition(): EnumType
    {
        $name = Helpers::formatAttribute($this->key, Helpers::PASCAL_CASE);

        $enum = (new EnumType($name))
            ->setType('string')
            ->setCases($this->cases());

        $methods = array_map(
            callback: fn (string $key) => $this->method($key),
            array: $this->properties(),
        );

        $enum->setMethods($methods);

        return $enum;
    }

    protected function method(string $property): Method
    {
        $regional = $this->isRegionalProperty($property);
        $name = Str::replaceStart('regionalRoute', '', $property);
        $name = Helpers::formatAttribute($regional ? "{$name}Regional" : $name, Helpers::CAMEL_CASE);
        $methodType = $this->methodType($property);

        return (new Method($name))
            ->setBody($this->methodBody($property))
            ->setReturnType($methodType['type'])
            ->setReturnNullable($methodType['nullable'])
            ->setPublic();
    }

    protected function properties(): array
    {
        return collect($this->items)
            ->map(fn (array $item) => array_keys($item))
            ->values()
            ->flatten()
            ->unique()
            ->filter(fn (string $key) => ! in_array($key, static::EXCLUDED_METHOD_KEYS))
            ->values()
            ->toArray();
    }

    /**
     * @return EnumCase[]
     */
    protected function cases(): array
    {
        return collect($this->items)
            ->map(function (array $item, string $key) {
                $case = (new EnumCase($this->caseName($key, $item['altName'] ?? null)))
                    ->setValue($key)
                    ->addComment("\n{$item['description']}\n");

                if ($item['deprecated'] ?? false) {
                    $case->addComment('@deprecated');
                }

                return $case;
            })
            ->values()
            ->toArray();
    }

    protected function caseName(string $key, ?string $name = null, ?string $property = null): string
    {
        $name ??= $key;

        $name = in_array($property ?? $this->key, static::UPPERCASED)
            ? Str::upper($name)
            : Helpers::formatAttribute($name, Helpers::PASCAL_CASE);

        if (array_key_exists($key, static::OVERRIDES)) {
            $name = static::OVERRIDES[$key];
        }

        return $name;
    }

    /**
     * @return class-string
     */
    protected function regionalClass(): string
    {
        return $this->namespace().'\\'.Helpers::formatAttribute('regional', Helpers::PASCAL_CASE);
    }

    /**
     * @return array{type: string, nullable: bool}
     */
    protected function methodType(string $property): array
    {
        $values = collect($this->items)
            ->pluck($property)
            ->values()->unique()->values();

        $nullable = $values->contains(null);

        if ($this->isRegionalProperty($property)) {
            return ['type' => $this->regionalClass(), 'nullable' => $nullable];
        }

        $types = $values
            ->filter(fn ($val) => $val !== null)
            ->flatMap(fn ($val) => collect(Type::fromValue($val)->getTypes())
                ->map(fn (Type $type) => (string) $type))
            ->values()->unique()->values()
            ->join('|');

        if (blank($types)) {
            $types = ['mixed'];
            $nullable = true;
        }

        if ($types === 'bool') {
            $nullable = false;
        }

        return ['type' => $types, 'nullable' => $nullable];
    }

    protected function isRegionalProperty(string $property): bool
    {
        return Str::startsWith($property, 'regionalRoute');
    }

    protected function methodBody(string $property): string
    {
        $regional = $this->isRegionalProperty($property);
        $regionalClass = GeneratorHelpers::extractShortName($this->regionalClass());
        $enumName = Helpers::formatAttribute($this->key, Helpers::PASCAL_CASE);
        $dumper = new Dumper;

        $methodType = $this->methodType($property);
        $type = $methodType['type'];

        $body = "return match (\$this) {\n";

        foreach ($this->items as $key => $item) {
            $caseName = $this->caseName($key, $item['altName'] ?? null);

            $matchType = $regional
                ? $regionalClass.'::'.$this->caseName($item[$property], property: $property)
                : $dumper->dump($item[$property] ?? null);

            if ($type === 'bool' && ($item[$property] ?? null) === null) {
                $matchType = 'false';
            }

            $body .= "    $enumName::$caseName => $matchType,\n";
        }

        $body .= '};';

        return $body;
    }
}
