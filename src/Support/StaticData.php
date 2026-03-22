<?php

namespace Phizz\Support;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

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

    public static function of(string $version = ''): CastsAttributes
    {
        return static::castUsing([$version]);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        $dataClass = static::class;
        $version = $arguments[0] ?? '';

        return new class($dataClass, $version) implements CastsAttributes
        {
            public function __construct(
                private readonly string $dataClass,
                private readonly string $version,
            ) {}

            public function get($model, string $key, mixed $value, array $attributes): mixed
            {
                if ($value === null) {
                    return null;
                }

                $data = is_string($value) ? json_decode($value, true) : $value;

                return new $this->dataClass($data, $this->version);
            }

            public function set($model, string $key, mixed $value, array $attributes): mixed
            {
                if ($value === null) {
                    return null;
                }

                return json_encode($value instanceof Data ? $value->toArray() : $value);
            }
        };
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
