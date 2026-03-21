<?php

use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Exceptions\InvalidPlatformException;
use Phizz\Support\Data;
use Phizz\Support\Helpers;

it('preserves plain snake_case attribute names', function () {
    expect(Helpers::formatAttribute('foo_bar'))->toBe('foo_bar');
});

it('converts camelCase attribute names to snake_case', function () {
    expect(Helpers::formatAttribute('fooBar'))->toBe('foo_bar');
});

it('converts PascalCase attribute names to snake_case', function () {
    expect(Helpers::formatAttribute('FooBar'))->toBe('foo_bar');
});

it('handles all-lowercase acronym tokens correctly', function () {
    expect(Helpers::formatAttribute('puuid'))->toBe('puuid');
});

it('splits trailing ID acronyms from a word', function () {
    expect(Helpers::formatAttribute('summonerID'))->toBe('summoner_id');
});

it('treats X as a separate prefix token', function () {
    expect(Helpers::formatAttribute('XOffset'))->toBe('x_offset');
});

it('spells out a leading numeric token in english', function () {
    expect(Helpers::formatAttribute('12kills'))->toBe('twelve_kills');
});

it('returns an empty string for empty input', function () {
    expect(Helpers::formatAttribute(''))->toBe('');
});

it('converts an attribute to camelCase when requested', function () {
    expect(Helpers::formatAttribute('foo_bar', Helpers::CAMEL_CASE))->toBe('fooBar')
        ->and(Helpers::formatAttribute('fooBar', Helpers::CAMEL_CASE))->toBe('fooBar');
});

it('converts an attribute to PascalCase when requested', function () {
    expect(Helpers::formatAttribute('foo_bar', Helpers::PASCAL_CASE))->toBe('FooBar')
        ->and(Helpers::formatAttribute('fooBar', Helpers::PASCAL_CASE))->toBe('FooBar');
});

it('resolves a Platform string value to itself', function () {
    $result = Helpers::resolvePlatform(Platform::class, 'na1', [], '/lol/test');

    expect($result)->toBe('na1');
});

it('resolves a Platform enum instance to its string value', function () {
    $result = Helpers::resolvePlatform(Platform::class, Platform::EUW, [], '/lol/test');

    expect($result)->toBe('euw1');
});

it('converts a Platform to its Regional equivalent for regional endpoints', function () {
    $result = Helpers::resolvePlatform(Regional::class, Platform::EUW, [], '/lol/match/v5/matches');

    expect($result)->toBe('europe');
});

it('converts a Platform to its LoR regional routing for /lor/ endpoints', function () {
    // RU maps to SEA via lorRegional() but Europe via regional()
    $result = Helpers::resolvePlatform(Regional::class, Platform::RU, [], '/lor/match/v1/matches');

    expect($result)->toBe('sea');
});

it('accepts a Regional enum instance directly', function () {
    $result = Helpers::resolvePlatform(Regional::class, Regional::Americas, [], '/lol/test');

    expect($result)->toBe('americas');
});

it('accepts a ValPlatform enum for Valorant endpoints', function () {
    $result = Helpers::resolvePlatform(ValPlatform::class, ValPlatform::NA, [], '/val/test');

    expect($result)->toBe('na');
});

it('throws when the platform is blank', function () {
    Helpers::resolvePlatform(Platform::class, null, [], '/lol/test');
})->throws(InvalidPlatformException::class);

it('throws when the platform type does not match the endpoint expectation', function () {
    Helpers::resolvePlatform(Regional::class, ValPlatform::NA, [], '/lol/test');
})->throws(InvalidPlatformException::class);

it('throws when the platform is not in the endpoint allow-list', function () {
    Helpers::resolvePlatform(Platform::class, Platform::NA, ['euw1', 'kr'], '/lol/test');
})->throws(InvalidPlatformException::class);

it('passes when the platform is in the endpoint allow-list', function () {
    $result = Helpers::resolvePlatform(Platform::class, Platform::EUW, ['euw1', 'na1'], '/lol/test');

    expect($result)->toBe('euw1');
});

it('returns null when the endpoint declares no return value', function () {
    expect(Helpers::resolveBody(['data'], false, null, null))->toBeNull();
});

it('returns the raw body when no return type is specified', function () {
    $body = ['key' => 'value'];

    expect(Helpers::resolveBody($body, true, null, null))->toBe($body);
});

it('wraps the body in the given return type', function () {
    $concreteClass = new class(['name' => 'test']) extends Data {};

    $result = Helpers::resolveBody(['name' => 'test'], true, get_class($concreteClass), null);

    expect($result)->toBeInstanceOf(get_class($concreteClass));
});

it('maps the body into a collection of the given collection type', function () {
    $concreteClass = new class([]) extends Data {};
    $className = get_class($concreteClass);

    $result = Helpers::resolveBody(
        [['name' => 'a'], ['name' => 'b']],
        true,
        null,
        $className,
    );

    expect($result)->toHaveCount(2)
        ->and($result->first())->toBeInstanceOf($className);
});
