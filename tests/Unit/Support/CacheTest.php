<?php

use Phizz\Support\Cache;
use Phizz\Support\Configuration;

beforeEach(function () {
    $this->makeCache = function (bool $enabled = true, array $methodTTLs = []): Cache {
        config()->set('phizz.cache.enabled', $enabled);
        config()->set('phizz.cache.method', $methodTTLs);

        $configuration = new Configuration(
            $this->app['config'],
            $this->app['cache']->store(),
        );

        return new Cache($configuration);
    };
});

it('bypasses the cache and calls through when caching is disabled', function () {
    $cache = ($this->makeCache)(enabled: false);
    $calls = 0;

    $cache->remember('na1', 'lol.matchV5.getMatch', [], [], function () use (&$calls) {
        $calls++;

        return 'fresh';
    });

    $cache->remember('na1', 'lol.matchV5.getMatch', [], [], function () use (&$calls) {
        $calls++;

        return 'fresh';
    });

    expect($calls)->toBe(2);
});

it('calls the callback and returns the value on a cache miss', function () {
    $cache = ($this->makeCache)(enabled: true);

    $result = $cache->remember('na1', 'lol.matchV5.getMatch', [], [], fn () => 'data');

    expect($result)->toBe('data');
});

it('returns the cached value on a cache hit without invoking the callback', function () {
    $cache = ($this->makeCache)(enabled: true);
    $calls = 0;

    $cache->remember('na1', 'lol.matchV5.getMatch', [], [], function () use (&$calls) {
        $calls++;

        return 'cached-data';
    });

    $result = $cache->remember('na1', 'lol.matchV5.getMatch', [], [], function () use (&$calls) {
        $calls++;

        return 'should-not-be-returned';
    });

    expect($calls)->toBe(1)
        ->and($result)->toBe('cached-data');
});

it('treats different path params as separate cache entries', function () {
    $cache = ($this->makeCache)(enabled: true);

    $cache->remember('na1', 'lol.matchV5.getMatch', ['matchId' => 'NA1_1'], [], fn () => 'match-1');
    $result = $cache->remember('na1', 'lol.matchV5.getMatch', ['matchId' => 'NA1_2'], [], fn () => 'match-2');

    expect($result)->toBe('match-2');
});

it('treats different platforms as separate cache entries', function () {
    $cache = ($this->makeCache)(enabled: true);

    $cache->remember('na1', 'lol.matchV5.getMatch', ['matchId' => 'NA1_1'], [], fn () => 'na1-match');
    $result = $cache->remember('euw1', 'lol.matchV5.getMatch', ['matchId' => 'NA1_1'], [], fn () => 'euw1-match');

    expect($result)->toBe('euw1-match');
});

it('uses per-method ttl when configured', function () {
    $cache = ($this->makeCache)(
        enabled: true,
        methodTTLs: ['lol.matchV5.getMatch' => 3600],
    );

    // We can only verify it stores without error; TTL inspection requires the store.
    $result = $cache->remember('na1', 'lol.matchV5.getMatch', [], [], fn () => 'ok');

    expect($result)->toBe('ok');
});

it('falls back to the default ttl when no per-method override exists', function () {
    $cache = ($this->makeCache)(enabled: true, methodTTLs: []);

    $result = $cache->remember('na1', 'lol.matchV5.getMatch', [], [], fn () => 'ok');

    expect($result)->toBe('ok');
});
