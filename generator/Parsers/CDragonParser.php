<?php

namespace Phizz\Generator\Parsers;

use GuzzleHttp\Client as Guzzle;
use Phizz\Generator\Objects\CDragonEndpoint;
use Phizz\Generator\Objects\CDragonField;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Fetches CommunityDragon JSON files and infers their field schema from a small sample.
 */
class CDragonParser
{
    private const BASE_URL = 'https://raw.communitydragon.org';

    private const JSON_INDEX = '/json/{version}/plugins/rcp-be-lol-game-data/global/default/v1/';

    private const DATA_PATH = '/{version}/plugins/rcp-be-lol-game-data/global/default/v1/{file}';

    private const ASSET_PREFIX = '/lol-game-data/assets';

    /** Number of items to sample when inferring schema */
    private const SAMPLE_SIZE = 5;

    private readonly Guzzle $guzzle;

    public function __construct(
        private readonly string $version,
        private readonly OutputInterface $console,
    ) {
        $this->guzzle = new Guzzle(['timeout' => 30]);
    }

    /**
     * Fetches the v1/ JSON index and inspects each non-empty JSON file.
     *
     * @return CDragonEndpoint[]
     */
    public function inspect(): array
    {
        $indexPath = str_replace('{version}', $this->version, self::JSON_INDEX);

        $this->console->writeln("  <fg=cyan>Fetching index from CommunityDragon ($this->version)...</>");

        $index = $this->fetch($indexPath);

        $files = array_filter(
            $index,
            fn ($entry) => ($entry['type'] ?? '') === 'file'
                && str_ends_with($entry['name'], '.json')
                && ($entry['size'] ?? 0) > 2
        );

        $directories = array_filter(
            $index,
            fn ($entry) => ($entry['type'] ?? '') === 'directory'
        );

        $endpoints = [];

        foreach ($files as $entry) {
            $endpoint = $this->inspectFile($entry['name']);

            if ($endpoint !== null) {
                $endpoints[] = $endpoint;
            }
        }

        foreach ($directories as $entry) {
            $endpoint = $this->inspectDirectory($entry['name'], $indexPath);

            if ($endpoint !== null) {
                $endpoints[] = $endpoint;
            }
        }

        return $endpoints;
    }

    private function inspectFile(string $file): ?CDragonEndpoint
    {
        $path = str_replace(
            ['{version}', '{file}'],
            [$this->version, $file],
            self::DATA_PATH,
        );

        $this->console->writeln("    <fg=gray>→ {$file}</>");

        $data = $this->fetch($path);

        if (empty($data)) {
            return null;
        }

        $isArray = array_is_list($data);
        $sample = $isArray ? array_slice($data, 0, self::SAMPLE_SIZE) : [$data];

        // Verify items are associative arrays (skip primitive arrays like versions.json)
        if (! is_array($sample[0]) || array_is_list($sample[0])) {
            return null;
        }

        // Skip numeric-keyed maps (e.g., skins.json is {1000: {...}, 1001: {...}})
        if (is_numeric(array_key_first($sample[0]))) {
            return null;
        }

        $fields = $this->inferFields($sample);
        $idField = $this->detectIdField($fields);

        return new CDragonEndpoint(
            file: $file,
            slug: substr($file, 0, -5), // strip .json
            isArray: $isArray,
            idField: $idField,
            fields: $fields,
        );
    }

    /**
     * Inspects a subdirectory. If it contains numeric-named JSON files,
     * samples one and returns a directory endpoint (fetched per ID).
     *
     * @param  string  $dir  Directory name, e.g. "champions"
     * @param  string  $indexPath  Parent index path (used to build sub-index URL)
     */
    private function inspectDirectory(string $dir, string $indexPath): ?CDragonEndpoint
    {
        $subIndexPath = rtrim($indexPath, '/').'/'.$dir.'/';

        $this->console->writeln("    <fg=gray>→ {$dir}/ (directory)</>");

        $listing = $this->fetch($subIndexPath);

        if ($listing === []) {
            return null;
        }

        // Only handle directories that contain numeric .json files
        $jsonFiles = array_filter(
            $listing,
            fn ($entry) => ($entry['type'] ?? '') === 'file'
                && str_ends_with($entry['name'], '.json')
                && is_numeric(substr($entry['name'], 0, -5))
                && ($entry['size'] ?? 0) > 2
        );

        if (count($jsonFiles) === 0) {
            return null;
        }

        // Sample the first few numeric JSON files to infer the schema
        $sampleFiles = array_slice(array_values($jsonFiles), 0, self::SAMPLE_SIZE);
        $sample = [];

        foreach ($sampleFiles as $entry) {
            $filePath = str_replace(
                ['{version}', '{file}'],
                [$this->version, $dir.'/'.$entry['name']],
                self::DATA_PATH,
            );

            $data = $this->fetch($filePath);

            if (! array_is_list($data)) {
                $sample[] = $data;
            }
        }

        if ($sample === []) {
            return null;
        }

        $fields = $this->inferFields($sample);

        return new CDragonEndpoint(
            file: $dir,
            slug: $dir,
            isArray: false,
            idField: null, // directory endpoints use the filename as the ID
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
        // Collect every key seen across all sample items
        $allKeys = [];
        foreach ($sample as $item) {
            foreach (array_keys($item) as $key) {
                $allKeys[$key] = true;
            }
        }

        $fields = [];

        foreach (array_keys($allKeys) as $key) {
            $values = [];
            $hasNull = false;
            $hasMissing = false;

            foreach ($sample as $item) {
                if (! array_key_exists($key, $item)) {
                    $hasMissing = true;
                } elseif ($item[$key] === null) {
                    $hasNull = true;
                } else {
                    $values[] = $item[$key];
                }
            }

            $nullable = $hasNull || $hasMissing;

            if (empty($values)) {
                $fields[] = new CDragonField($key, 'mixed', true, false, false);

                continue;
            }

            $first = $values[0];

            if (is_bool($first)) {
                $fields[] = new CDragonField($key, 'bool', $nullable, false, false);
            } elseif (is_int($first)) {
                $fields[] = new CDragonField($key, 'int', $nullable, false, false);
            } elseif (is_float($first)) {
                $fields[] = new CDragonField($key, 'float', $nullable, false, false);
            } elseif (is_array($first)) {
                if (array_is_list($first)) {
                    // List — check if items are objects
                    $listItems = [];

                    foreach ($values as $v) {
                        if (! is_array($v)) {
                            continue;
                        }

                        foreach ($v as $item) {
                            if (is_array($item) && ! array_is_list($item)
                                && ! is_numeric(array_key_first($item))) {
                                $listItems[] = $item;

                                if (count($listItems) >= self::SAMPLE_SIZE) {
                                    break 2;
                                }
                            }
                        }
                    }

                    if (! empty($listItems)) {
                        $subFields = $this->inferFields($listItems);
                        $fields[] = new CDragonField($key, 'array', $nullable, false, true, $subFields);
                    } else {
                        $fields[] = new CDragonField($key, 'array', $nullable, false, true);
                    }
                } else {
                    // Associative sub-object — skip numeric-keyed or UUID/hyphen-keyed maps
                    $firstKeys = array_keys($first);
                    $isUntypedMap = array_filter(
                        $firstKeys,
                        fn ($k) => is_numeric($k) || str_contains((string) $k, '-'),
                    ) !== [];

                    if ($isUntypedMap) {
                        $fields[] = new CDragonField($key, 'array', $nullable, false, false);
                    } else {
                        $objSamples = array_values(array_filter($values, fn ($v) => is_array($v) && ! array_is_list($v)));
                        $subFields = ! empty($objSamples) ? $this->inferFields($objSamples) : [];
                        $fields[] = new CDragonField($key, 'array', $nullable, false, false, $subFields, true);
                    }
                }
            } elseif (is_string($first)) {
                $isPath = $this->isPathField($key, $values);
                $fields[] = new CDragonField($key, 'string', $nullable, $isPath, false);
            } else {
                $fields[] = new CDragonField($key, 'mixed', $nullable, false, false);
            }
        }

        return $fields;
    }

    /**
     * A field is a CommunityDragon asset path if its name ends in "Path" and at least
     * one sampled value starts with the /lol-game-data/assets prefix.
     *
     * @param  string[]  $values
     */
    private function isPathField(string $key, array $values): bool
    {
        if (! str_ends_with($key, 'Path')) {
            return false;
        }

        foreach ($values as $value) {
            if (stripos($value, self::ASSET_PREFIX) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  CDragonField[]  $fields
     */
    private function detectIdField(array $fields): ?string
    {
        foreach ($fields as $field) {
            if ($field->name === 'id' && $field->phpType === 'int') {
                return 'id';
            }
        }

        return null;
    }

    private function fetch(string $path): array
    {
        $response = $this->guzzle->get(self::BASE_URL.$path);

        return json_decode((string) $response->getBody(), true) ?? [];
    }
}
