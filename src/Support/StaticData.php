<?php

namespace Phizz\Support;

/**
 * @internal
 */
abstract class StaticData extends Data
{
    protected const PLUGIN_BASE = 'plugins/rcp-be-lol-game-data/global/default';

    protected const ASSET_PREFIX = '/lol-game-data/assets';

    public function __construct(array $attributes = [], protected readonly string $version = '')
    {
        parent::__construct($attributes);
    }

    protected function makeObject(string $class, mixed $value): Data
    {
        return new $class($value, $this->version);
    }

    protected function toUrl(string $path): string
    {
        return Helpers::toStaticUrl($this->version, $path);
    }
}
