<?php

use Illuminate\Contracts\Foundation\Application;
use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\Support\Constructable;
use Phizz\Support\HttpClient;

class TestLeafClient extends Constructable {}

class TestParentClient extends Constructable
{
    protected array $constructable = [
        'leaf' => TestLeafClient::class,
    ];
}

function makeConstructable(): TestParentClient
{
    /** @var Application $app */
    $app = app();

    $configuration = new Configuration(
        $app['config'],
        $app['cache']->store(),
    );

    $httpClient = new HttpClient($configuration, new Cache($configuration));

    return new TestParentClient($configuration, $httpClient);
}

it('returns a child client via property access', function () {
    $client = makeConstructable();

    expect($client->leaf)->toBeInstanceOf(TestLeafClient::class);
});

it('caches the child client instance on repeated property access', function () {
    $client = makeConstructable();

    expect($client->leaf)->toBe($client->leaf);
});

it('throws when accessing an unregistered property', function () {
    $client = makeConstructable();

    $client->unknown;
})->throws(InvalidArgumentException::class, 'Property [unknown] is not available.');

it('returns a child client via method call without a platform argument', function () {
    $client = makeConstructable();

    expect($client->leaf())->toBeInstanceOf(TestLeafClient::class);
});

it('returns a new platform-scoped child client when called with a platform argument', function () {
    $client = makeConstructable();

    $scoped = $client->leaf('euw1');

    expect($scoped)->toBeInstanceOf(TestLeafClient::class);
});

it('does not cache platform-scoped instances', function () {
    $client = makeConstructable();

    expect($client->leaf('euw1'))->not->toBe($client->leaf('euw1'));
});

it('throws when calling an unregistered method', function () {
    $client = makeConstructable();

    $client->unknown();
})->throws(InvalidArgumentException::class, 'Method [unknown] is not available.');
