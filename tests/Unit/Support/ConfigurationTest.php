<?php

use Phizz\Retry;
use Phizz\Support\Configuration;

beforeEach(function () {
    $this->config = fn () => new Configuration(
        $this->app['config'],
        $this->app['cache']->store(),
    );
});

it('reads the api key from config', function () {
    $configuration = ($this->config)();

    expect($configuration->apiKey)->toBe('RGAPI-test-key');
});

it('reads the default platform from config', function () {
    $configuration = ($this->config)();

    expect($configuration->platform)->toBe('na1');
});

it('reads the timeout from config', function () {
    $configuration = ($this->config)();

    expect($configuration->timeout)->toBe(30);
});

it('reads cacheResponses as false when cache is disabled', function () {
    $configuration = ($this->config)();

    expect($configuration->cacheResponses)->toBeFalse();
});

it('reads cacheResponses as true when cache is enabled', function () {
    config()->set('phizz.cache.enabled', true);
    $configuration = ($this->config)();

    expect($configuration->cacheResponses)->toBeTrue();
});

it('reads the default ttl from config', function () {
    $configuration = ($this->config)();

    expect($configuration->ttl)->toBe(60);
});

it('reads per-method ttl overrides from config', function () {
    config()->set('phizz.cache.method', ['lol.matchV5.getMatch' => 600]);
    $configuration = ($this->config)();

    expect($configuration->methodTTLs)->toBe(['lol.matchV5.getMatch' => 600]);
});

it('defaults to an empty method ttl map when not configured', function () {
    $configuration = ($this->config)();

    expect($configuration->methodTTLs)->toBeArray()->toBeEmpty();
});

it('defaults the retry strategy to exponential', function () {
    $configuration = ($this->config)();

    expect($configuration->retryStrategy)->toBeInstanceOf(Retry::class)
        ->and($configuration->retryStrategy->delay(0))->toBe(1)
        ->and($configuration->retryStrategy->delay(1))->toBe(2);
});

it('accepts a custom retry strategy from config', function () {
    config()->set('phizz.retry.strategy', Retry::fixed(5));
    $configuration = ($this->config)();

    expect($configuration->retryStrategy->delay(0))->toBe(5)
        ->and($configuration->retryStrategy->delay(3))->toBe(5);
});
