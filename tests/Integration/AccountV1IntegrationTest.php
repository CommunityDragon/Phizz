<?php

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Support\Sleep;
use Phizz\Apis\Riot\AccountV1\AccountV1Api;
use Phizz\Apis\Riot\AccountV1\Objects\AccountData;
use Phizz\Cache\Riot\AccountV1Ttl;
use Phizz\Enums\Regional;
use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\Support\HttpClient;

/**
 * Builds an AccountV1Api wired to a real Guzzle client.
 * Pass a reference to $history to inspect recorded HTTP transactions.
 *
 * @param  array<int, array<string, mixed>>  $history
 */
function makeAccountApi(array &$history = []): AccountV1Api
{
    $stack = HandlerStack::create();
    $stack->push(Middleware::history($history));

    $guzzle = new Guzzle(['handler' => $stack]);
    $config = new Configuration(app()['config'], app()['cache']->store());
    $cache = new Cache($config);
    $httpClient = new HttpClient($config, $cache, $guzzle);

    return new AccountV1Api($config, $httpClient);
}

it('returns a valid AccountData for Hide on bush#KR1 via asia region', function () {
    $account = makeAccountApi()->getByRiotId(
        tagLine: 'KR1',
        gameName: 'Hide on bush',
        platform: Regional::Asia,
    );

    expect($account)->toBeInstanceOf(AccountData::class)
        ->and($account->puuid)->toHaveLength(78)
        ->and($account->game_name)->toBe('Hide on bush')
        ->and($account->tag_line)->toBe('KR1');
});

it('returns a valid AccountData for IAmTheWhite#EUW via europe region', function () {
    $account = makeAccountApi()->getByRiotId(
        tagLine: 'EUW',
        gameName: 'IAmTheWhite',
        platform: Regional::Europe,
    );

    expect($account)->toBeInstanceOf(AccountData::class)
        ->and($account->puuid)->toHaveLength(78)
        ->and($account->game_name)->toBe('IAmTheWhite')
        ->and($account->tag_line)->toBe('EUW');
});

it('serves the second identical request from cache without a new HTTP call', function () {
    $history = [];
    $api = makeAccountApi($history);

    $first = $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);
    $second = $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);

    expect(count($history))->toBe(1)
        ->and($second->puuid)->toBe($first->puuid);
});

it('does not share cache entries between different accounts', function () {
    $history = [];
    $api = makeAccountApi($history);

    $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);
    $api->getByRiotId(tagLine: 'EUW', gameName: 'IAmTheWhite', platform: Regional::Europe);

    expect(count($history))->toBe(2);
});

it('force=true bypasses the cache and issues a fresh HTTP request', function () {
    $history = [];
    $api = makeAccountApi($history);

    // prime the cache
    $first = $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);
    expect(count($history))->toBe(1);

    // force bypasses cache → second HTTP request
    $forced = $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia, force: true);
    expect(count($history))->toBe(2)
        ->and($forced->puuid)->toBe($first->puuid);
});

it('force=true does not populate the cache so subsequent normal calls still hit the network', function () {
    $history = [];
    $api = makeAccountApi($history);

    // force=true bypasses the cache entirely — no read and no write
    $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia, force: true);
    // cache is still empty, so this normal call must also hit the network
    $api->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);

    expect(count($history))->toBe(2);
});

it('stores app-level rate limit state in cache after a real request', function () {
    makeAccountApi()->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);

    $store = app()['cache']->store();
    $state = $store->get('phizz.ratelimit.app.Regional.asia');

    expect($state)->not->toBeNull()
        ->and($state)->toBeArray()
        ->and($state)->not->toBeEmpty();

    $window = array_values($state)[0];
    expect($window)->toHaveKeys(['count', 'window', 'limit', 'expires_at'])
        ->and($window['count'])->toBeGreaterThanOrEqual(1)
        ->and($window['limit'])->toBeGreaterThan(0);
});

it('stores method-level rate limit state in cache after a real request', function () {
    makeAccountApi()->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);

    $store = app()['cache']->store();
    $state = $store->get('phizz.ratelimit.method.asia.'.AccountV1Ttl::getByRiotId);

    expect($state)->not->toBeNull()
        ->and($state)->toBeArray()
        ->and($state)->not->toBeEmpty();

    $window = array_values($state)[0];
    expect($window)->toHaveKeys(['count', 'window', 'limit', 'expires_at'])
        ->and($window['count'])->toBeGreaterThanOrEqual(1)
        ->and($window['limit'])->toBeGreaterThan(0);
});

it('does not sleep when the rate limit is not exhausted', function () {
    Sleep::fake();

    makeAccountApi()->getByRiotId(tagLine: 'KR1', gameName: 'Hide on bush', platform: Regional::Asia);

    Sleep::assertNeverSlept();
});
