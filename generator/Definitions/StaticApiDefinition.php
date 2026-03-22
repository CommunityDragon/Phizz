<?php

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Nette\PhpGenerator\ClassType;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Objects\CDragonEndpoint;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\StaticApi;

/**
 * Generates a static API class for one JSON endpoint.
 * Produces: all(), get(id), and a cached fetch().
 *
 * @extends Definition<ClassType>
 */
class StaticApiDefinition extends Definition implements Writable
{
    use HasWrite;

    public function __construct(
        private readonly CDragonEndpoint $endpoint,
        private readonly StaticDataDefinition $dataDefinition,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('CDragon\\'.Str::studly($this->endpoint->slug));
    }

    public function directory(): string
    {
        return $this->resolvePath('CDragon/'.Str::studly($this->endpoint->slug));
    }

    public function imports(): array
    {
        $imports = [
            StaticApi::class,
            $this->dataDefinition->className(),
        ];

        if (! $this->endpoint->isDirectory) {
            $imports[] = Collection::class;

            if ($this->endpoint->idField !== null) {
                $imports[] = InvalidArgumentException::class;
            }
        }

        return $imports;
    }

    public function definition(): ClassType
    {
        $dataShort = $this->dataShortName();
        $class = (new ClassType($this->shortClassName()))
            ->setExtends(StaticApi::class);

        if ($this->endpoint->isDirectory) {
            $this->buildDirectoryEndpoint($class, $dataShort);
        } else {
            $this->buildFlatEndpoint($class, $dataShort);
        }

        return $class;
    }

    /**
     * Flat-file endpoint (e.g. items.json): all(), get(id), cached fetch().
     */
    private function buildFlatEndpoint(ClassType $class, string $dataShort): void
    {
        // Cache property (single array for the whole list)
        $class->addProperty('cache')
            ->setPrivate()
            ->setType('?array')
            ->setValue(null);

        // all()
        $allMethod = $class->addMethod('all')
            ->setReturnType(Collection::class)
            ->addComment("@return Collection<int, {$dataShort}>");
        $allMethod->setBody(
            "return collect(\$this->fetch())->map(fn (\$item) => new {$dataShort}(\$item, \$this->version));"
        );

        // get(id) — only if an id field exists
        if ($this->endpoint->idField !== null) {
            $idField = $this->endpoint->idField;
            $getMethod = $class->addMethod('get')
                ->setReturnType($this->dataDefinition->className())
                ->addComment("@return {$dataShort}");
            $getMethod->addParameter('id')->setType('int');
            $getMethod->setBody(
                "\$item = collect(\$this->fetch())->firstWhere('{$idField}', \$id);\n\n".
                "if (\$item === null) {\n".
                "    throw new InvalidArgumentException(\"Item '{\$id}' not found.\");\n".
                "}\n\n".
                "return new {$dataShort}(\$item, \$this->version);"
            );
        }

        // private fetch()
        $fetchMethod = $class->addMethod('fetch')
            ->setPrivate()
            ->setReturnType('array');
        $jsonPath = "/{$this->endpoint->slug}.json";
        $fetchMethod->setBody(
            "return \$this->cache ??= \$this->http->cdragon(\n".
            "    \"/{$this->versionPlaceholder()}/\".self::PLUGIN_BASE.\"/v1{$jsonPath}\"\n".
            ');'
        );
    }

    /**
     * Directory endpoint (e.g. champions/{id}.json): get(id), per-ID fetch().
     */
    private function buildDirectoryEndpoint(ClassType $class, string $dataShort): void
    {
        $slug = $this->endpoint->slug;

        // get(int $id): XxxData
        $getMethod = $class->addMethod('get')
            ->setReturnType($this->dataDefinition->className())
            ->addComment("@return {$dataShort}");
        $getMethod->addParameter('id')->setType('int');
        $getMethod->setBody("return new {$dataShort}(\$this->fetch(\$id), \$this->version);");

        // private fetch(int $id): array — no in-memory cache (each id is different)
        $fetchMethod = $class->addMethod('fetch')
            ->setPrivate()
            ->setReturnType('array');
        $fetchMethod->addParameter('id')->setType('int');
        $fetchMethod->setBody(
            "return \$this->http->cdragon(\n".
            "    \"/{$this->versionPlaceholder()}/\".self::PLUGIN_BASE.\"/v1/{$slug}/{\$id}.json\"\n".
            ');'
        );
    }

    public function className(): string
    {
        return $this->namespace().'\\'.$this->shortClassName();
    }

    private function shortClassName(): string
    {
        return Str::studly($this->endpoint->slug).'Api';
    }

    private function dataShortName(): string
    {
        return Str::studly(Str::singular($this->endpoint->slug)).'Data';
    }

    private function versionPlaceholder(): string
    {
        return '{$this->version}';
    }
}
