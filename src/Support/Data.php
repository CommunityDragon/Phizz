<?php

namespace Phizz\Support;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

/**
 * @internal
 */
abstract class Data extends Fluent implements Castable
{
    use Macroable {
        __call as macroCall;
        __callStatic as macroCallStatic;
    }

    /**
     * The attributes that should be cast as objects.
     *
     * @var array<string, class-string<Data>>
     */
    protected array $objects = [];

    /**
     * The attributes that should be cast as collections.
     *
     * @var array<int|string, string>
     */
    protected array $collections = [];

    /**
     * {@inheritdoc}
     */
    public static function castUsing(array $arguments): CastsAttributes
    {
        $dataClass = static::class;

        return new class($dataClass) implements CastsAttributes
        {
            public function __construct(private readonly string $dataClass) {}

            public function get($model, string $key, mixed $value, array $attributes): mixed
            {
                if ($value === null) {
                    return null;
                }

                $data = is_string($value) ? json_decode($value, true) : $value;

                return new $this->dataClass($data);
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

    /**
     * {@inheritdoc}
     */
    public function __construct($attributes = [])
    {
        $attrs = [];

        foreach ($attributes as $key => $value) {
            $key = Helpers::formatAttribute($key);

            if (array_key_exists($key, $this->collections)) {
                $attrs[Helpers::formatAttribute($key, Helpers::CAMEL_CASE)] = collect($value)
                    ->map(fn ($item) => $this->makeObject($this->collections[$key], $item));

                continue;
            }

            if (in_array($key, $this->collections) && is_numeric(array_search($key, $this->collections))) {
                $attrs[Helpers::formatAttribute($key, Helpers::CAMEL_CASE)] = collect($value);

                continue;
            }

            if (array_key_exists($key, $this->objects)) {
                $attrs[Helpers::formatAttribute($key, Helpers::CAMEL_CASE)] = $this->makeObject($this->objects[$key], $value);

                continue;
            }

            $attrs[$key] = $value;
        }

        parent::__construct($attrs);
    }

    /**
     * Instantiates the nested object.
     */
    protected function makeObject(string $class, mixed $value): Data
    {
        return new $class($value);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return static::macroCallStatic($method, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $attributes = parent::toArray();

        foreach ($attributes as $key => $value) {
            $attributes[$key] = $value instanceof Arrayable ? $value->toArray() : $value;
        }

        return $attributes;
    }
}
