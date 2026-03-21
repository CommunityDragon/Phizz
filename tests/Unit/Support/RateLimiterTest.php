<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Sleep;
use Phizz\Enums\Platform;
use Phizz\Support\Configuration;
use Phizz\Support\RateLimiter;

beforeEach(function () {
    $configuration = new Configuration(
        $this->app['config'],
        $this->app['cache']->store(),
    );

    $this->rateLimiter = new RateLimiter($configuration);
});

it('does not sleep when no rate limit state is cached', function () {
    Sleep::fake();

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertNeverSlept();
});

it('does not sleep when all windows have counts below their limits', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1,100:120',
            'X-App-Rate-Limit-Count' => '1:1,1:120',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '1:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertNeverSlept();
});

it('sleeps when an app-level rate limit window is exhausted', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1,100:120',
            'X-App-Rate-Limit-Count' => '20:1,1:120',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '1:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertSleptTimes(1);
});

it('sleeps when a method-level rate limit window is exhausted', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1,100:120',
            'X-App-Rate-Limit-Count' => '1:1,1:120',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '2000:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertSleptTimes(1);
});

it('uses the longest exhausted window as the sleep duration', function () {
    Sleep::fake();

    // 1-second window exhausted (limit=20, count=20) and 120-second window not exhausted
    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1,100:120',
            'X-App-Rate-Limit-Count' => '20:1,1:120',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '1:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertSlept(fn ($duration) => $duration->totalSeconds >= 1 && $duration->totalSeconds <= 2);
});

it('skips storing limits when headers are blank', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertNeverSlept();
});

it('scopes app limits by platform type so other platforms are unaffected', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1',
            'X-App-Rate-Limit-Count' => '20:1',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '1:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    // euw1 has no stored state, so it should not sleep
    $this->rateLimiter->wait('euw1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertNeverSlept();
});

it('scopes method limits by cache key so other endpoints are unaffected', function () {
    Sleep::fake();

    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1',
            'X-App-Rate-Limit-Count' => '1:1',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '2000:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    // Different cache key — no stored state
    $this->rateLimiter->wait('na1', Platform::class, 'lol.summonerV4.getBySummonerName');

    Sleep::assertNeverSlept();
});

it('handles multiple windows in a single header', function () {
    Sleep::fake();

    // Neither window is exhausted
    $this->rateLimiter->update(
        new Response(200, [
            'X-App-Rate-Limit' => '20:1,100:120',
            'X-App-Rate-Limit-Count' => '5:1,10:120',
            'X-Method-Rate-Limit' => '2000:60',
            'X-Method-Rate-Limit-Count' => '500:60',
        ]),
        'na1', Platform::class, 'lol.matchV5.getMatch',
    );

    $this->rateLimiter->wait('na1', Platform::class, 'lol.matchV5.getMatch');

    Sleep::assertNeverSlept();
});
