<?php

namespace Phizz\Support;

use InvalidArgumentException;

/**
 * @internal
 */
abstract class StaticApi
{
    protected const PLUGIN_BASE = 'plugins/rcp-be-lol-game-data/global/default';

    protected const ASSET_PREFIX = '/lol-game-data/assets';

    private array $cache = [];

    public function __construct(
        protected readonly string $version,
        protected readonly StaticClient $http,
    ) {}

    /**
     * Fetches a CommunityDragon JSON resource and optionally maps it to typed objects.
     * Responses are cached in-memory by path for the lifetime of this instance.
     *
     * @param  string  $path  Path relative to the plugin base, e.g. "/v1/items.json".
     * @param  string|null  $returnType  FQCN to instantiate from the root object response.
     * @param  string|null  $collectionType  FQCN for each item in a list response.
     * @param  string|null  $idField  Field to match against $id when filtering a list.
     * @param  int|null  $id  When set with $idField, filters the list for this id.
     * @return mixed Typed object, Collection of typed objects, or raw array.
     */
    protected function fetch(
        string $path,
        ?string $returnType = null,
        ?string $collectionType = null,
        ?string $idField = null,
        ?int $id = null,
    ): mixed {
        $data = $this->cache[$path] ??= $this->http->cdragon(
            "/{$this->version}/".self::PLUGIN_BASE.$path
        );

        if ($returnType !== null) {
            return new $returnType($data, $this->version);
        }

        if ($collectionType !== null && $id !== null && $idField !== null) {
            $item = collect($data)->firstWhere($idField, $id);

            if ($item === null) {
                throw new InvalidArgumentException("Item '{$id}' not found.");
            }

            return new $collectionType($item, $this->version);
        }

        if ($collectionType !== null) {
            return collect($data)->map(fn ($item) => new $collectionType($item, $this->version));
        }

        return $data;
    }

    protected function toUrl(string $path): string
    {
        return Helpers::toStaticUrl($this->version, $path);
    }
}
