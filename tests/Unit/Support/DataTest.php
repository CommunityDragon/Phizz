<?php

use Phizz\Support\Data;

it('stores plain attributes in snake_case', function () {
    $data = new class(['fooBar' => 'value']) extends Data {};

    expect($data->foo_bar)->toBe('value');
});

it('accesses plain attributes via array access', function () {
    $data = new class(['score' => 42]) extends Data {};

    expect($data['score'])->toBe(42);
});

it('casts nested objects declared in $objects', function () {
    $nestedClass = new class([]) extends Data {};

    $data = new class(['nested' => ['id' => 1]], $nestedClass::class) extends Data
    {
        public function __construct(array $attrs, string $nestedClass)
        {
            $this->objects = ['nested' => $nestedClass];
            parent::__construct($attrs);
        }
    };

    expect($data->nested)->toBeInstanceOf($nestedClass::class);
});

it('stores the nested object under the camelCase key', function () {
    $nestedClass = new class([]) extends Data {};

    $data = new class(['nested_item' => ['id' => 2]], $nestedClass::class) extends Data
    {
        public function __construct(array $attrs, string $nestedClass)
        {
            $this->objects = ['nested_item' => $nestedClass];
            parent::__construct($attrs);
        }
    };

    // nested_item -> stored as nestedItem (camelCase)
    expect($data->nestedItem)->toBeInstanceOf($nestedClass::class);
});

it('casts typed collections declared with a class in $collections', function () {
    $itemClass = new class([]) extends Data {};

    $data = new class([['id' => 1], ['id' => 2]], $itemClass::class) extends Data
    {
        public function __construct(array $items, string $itemClass)
        {
            $this->collections = ['items' => $itemClass];
            parent::__construct(['items' => $items]);
        }
    };

    expect($data->items)->toHaveCount(2)
        ->and($data->items->first())->toBeInstanceOf($itemClass::class);
});

it('casts untyped collections declared with a numeric key in $collections', function () {
    $data = new class([['id' => 1], ['id' => 2]]) extends Data
    {
        public function __construct(array $items)
        {
            $this->collections = ['tags'];
            parent::__construct(['tags' => $items]);
        }
    };

    expect($data->tags)->toHaveCount(2)
        ->and($data->tags->first())->toBe(['id' => 1]);
});

it('converts nested Arrayable instances in toArray()', function () {
    $nestedClass = new class(['val' => 99]) extends Data {};

    $data = new class(['nested' => ['val' => 99]], $nestedClass::class) extends Data
    {
        public function __construct(array $attrs, string $nestedClass)
        {
            $this->objects = ['nested' => $nestedClass];
            parent::__construct($attrs);
        }
    };

    $array = $data->toArray();

    expect($array['nested'])->toBeArray()
        ->and($array['nested']['val'])->toBe(99);
});

it('falls back to Fluents fluent setter when no macro matches', function () {
    $data = new class([]) extends Data {};

    $result = $data->foo('bar');

    expect($data->foo)->toBe('bar')
        ->and($result)->toBe($data);
});

it('supports instance macros via __call', function () {
    $concrete = new class([]) extends Data {};

    $concrete::macro('greeting', fn () => 'hello');

    expect($concrete->greeting())->toBe('hello');
});

it('supports static macros via __callStatic', function () {
    $concreteClass = new class([]) extends Data {};

    $concreteClass::macro('version', fn () => 42);

    expect($concreteClass::version())->toBe(42);
});
