<?php

namespace Phizz\Generator\Parsers;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Phizz\Generator\Objects\CDragonEndpoint;
use Phizz\Generator\Objects\CDragonField;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @extends FileParser<CDragonEndpoint[]>
 */
class StaticParser extends FileParser
{
    public const BASE_URL = 'https://raw.communitydragon.org';

    public const JSON_INDEX = '/json/{version}/plugins/rcp-be-lol-game-data/global/default/v1/';

    public const DATA_PATH = '/{version}/plugins/rcp-be-lol-game-data/global/default/v1/{file}';

    public const ASSET_PREFIX = '/lol-game-data/assets';

    protected const SAMPLE_SIZE = 5;

    public function __construct(
        OutputInterface $console,
        protected readonly Guzzle $guzzle = new Guzzle(['timeout' => 30]),
    ) {
        parent::__construct(console: $console);
    }

    protected function parseEntry(string $entry): mixed
    {
        return parent::parse(self::BASE_URL.$entry);
    }

    public function parse(string $entry): array
    {
        $version = $entry;
        $root = str_replace('{version}', $version, self::JSON_INDEX);

        /** @var Collection<int, array<string, mixed>> $index */
        $index = collect($this->parseEntry($root));

        $files = $index
            ->filter(fn (array $item) => ($item['type'] ?? '') === 'file')
            ->filter(fn (array $item) => Str::endsWith($item['name'], '.json'))
            ->filter(fn (array $item) => ($item['size'] ?? 0) > 2)
            ->pluck('name')
            ->values();

        $directories = $index
            ->filter(fn (array $item) => ($item['type'] ?? '') === 'directory')
            ->pluck('name')
            ->values();

        return [
            ...$files
                ->map(fn (string $file) => $this->inspectFile($version, $file))
                ->filter()
                ->all(),
            ...$directories
                ->map(fn (string $dir) => $this->inspectDirectory($version, $dir, $root))
                ->filter()
                ->all(),
        ];
    }

    private function resolvePath(string $version, string $file): string
    {
        return str_replace(['{version}', '{file}'], [$version, $file], self::DATA_PATH);
    }

    private function inspectFile(string $version, string $file): ?CDragonEndpoint
    {
        $data = $this->parseEntry($this->resolvePath($version, $file));

        if (empty($data)) {
            return null;
        }

        $isArray = array_is_list($data);
        $sample = $isArray ? array_slice($data, 0, self::SAMPLE_SIZE) : [$data];

        // skip primitive arrays (e.g. versions.json)
        if (! is_array($sample[0]) || array_is_list($sample[0])) {
            return null;
        }

        // numeric-keyed map (e.g. skins.json: {1000: {...}, 1001: {...}}) — treat values as collection
        if (is_numeric(array_key_first($sample[0]))) {
            $values = array_slice(array_values($sample[0]), 0, self::SAMPLE_SIZE);

            if (! is_array($values[0]) || array_is_list($values[0])) {
                return null;
            }

            return $this->makeEndpoint($file, isArray: true, sample: $values);
        }

        return $this->makeEndpoint($file, isArray: $isArray, sample: $sample);
    }

    private function makeEndpoint(string $file, bool $isArray, array $sample): CDragonEndpoint
    {
        $fields = $this->inferFields($sample);

        return new CDragonEndpoint(
            file: $file,
            slug: substr($file, 0, -5),
            isArray: $isArray,
            idField: $this->detectIdField($fields),
            fields: $fields,
        );
    }

    private function inspectDirectory(string $version, string $dir, string $root): ?CDragonEndpoint
    {
        $subroot = rtrim($root, '/').'/'.$dir.'/';

        $jsonFiles = collect($this->parseEntry($subroot))
            ->filter(fn (array $entry) => ($entry['type'] ?? '') === 'file'
                && str_ends_with($entry['name'], '.json')
                && is_numeric(substr($entry['name'], 0, -5))
                && ($entry['size'] ?? 0) > 2
            )
            ->take(self::SAMPLE_SIZE)
            ->values();

        if ($jsonFiles->isEmpty()) {
            return null;
        }

        $sample = $jsonFiles
            ->map(fn (array $entry) => $this->parseEntry($this->resolvePath($version, $dir.'/'.$entry['name'])))
            ->reject(fn (mixed $data) => ! is_array($data) || array_is_list($data))
            ->values()
            ->all();

        if (empty($sample)) {
            return null;
        }

        $fields = $this->inferFields($sample);

        return new CDragonEndpoint(
            file: $dir,
            slug: $dir,
            isArray: false,
            idField: null,
            fields: $fields,
            isDirectory: true,
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $sample
     * @return CDragonField[]
     */
    private function inferFields(array $sample): array
    {
        return collect($sample)
            ->flatMap(fn (array $item) => array_keys($item))
            ->unique()
            ->map(fn (string $key) => $this->buildField($key, $sample))
            ->values()
            ->all();
    }

    private function buildField(string $key, array $sample): CDragonField
    {
        $values = collect($sample)
            ->filter(fn (array $item) => array_key_exists($key, $item) && $item[$key] !== null)
            ->pluck($key)
            ->values()
            ->all();

        $nullable = collect($sample)->contains(
            fn (array $item) => ! array_key_exists($key, $item) || $item[$key] === null
        );

        if (empty($values)) {
            return new CDragonField($key, 'mixed', true, false, false);
        }

        $first = $values[0];

        return match (true) {
            is_bool($first) => new CDragonField($key, 'bool', $nullable, false, false),
            is_int($first) => new CDragonField($key, 'int', $nullable, false, false),
            is_float($first) => new CDragonField($key, 'float', $nullable, false, false),
            is_string($first) => new CDragonField($key, 'string', $nullable, $this->isPathField($key, $values), false),
            is_array($first) && array_is_list($first) => $this->buildListField($key, $nullable, $values),
            is_array($first) => $this->buildObjectField($key, $nullable, $values, $first),
            default => new CDragonField($key, 'mixed', $nullable, false, false),
        };
    }

    private function buildListField(string $key, bool $nullable, array $values): CDragonField
    {
        $listItems = collect($values)
            ->filter(fn (mixed $v) => is_array($v))
            ->flatMap(fn (array $v) => $v)
            ->filter(fn (mixed $item) => is_array($item)
                && ! array_is_list($item)
                && ! is_numeric(array_key_first($item))
            )
            ->take(self::SAMPLE_SIZE)
            ->values()
            ->all();

        $subFields = ! empty($listItems) ? $this->inferFields($listItems) : [];

        return new CDragonField($key, 'array', $nullable, false, true, $subFields);
    }

    private function buildObjectField(string $key, bool $nullable, array $values, array $first): CDragonField
    {
        $isUntypedMap = collect(array_keys($first))
            ->contains(fn (mixed $k) => is_numeric($k) || str_contains((string) $k, '-'));

        if ($isUntypedMap) {
            return new CDragonField($key, 'array', $nullable, false, false);
        }

        $objSamples = collect($values)
            ->filter(fn (mixed $v) => is_array($v) && ! array_is_list($v))
            ->values()
            ->all();

        $subFields = ! empty($objSamples) ? $this->inferFields($objSamples) : [];

        return new CDragonField($key, 'array', $nullable, false, false, $subFields, true);
    }

    /**
     * A field is a CommunityDragon asset path if its name ends in "Path" and at least
     * one sampled value starts with the /lol-game-data/assets prefix.
     *
     * @param  string[]  $values
     */
    private function isPathField(string $key, array $values): bool
    {
        return str_ends_with($key, 'Path')
            && collect($values)->contains(fn (string $v) => stripos($v, self::ASSET_PREFIX) === 0);
    }

    /**
     * @param  CDragonField[]  $fields
     */
    private function detectIdField(array $fields): ?string
    {
        return collect($fields)
            ->first(fn (CDragonField $f) => $f->name === 'id' && $f->phpType === 'int')
            ?->name;
    }

    protected function parseContent(string $content): mixed
    {
        return json_decode($content, true) ?? [];
    }
}
