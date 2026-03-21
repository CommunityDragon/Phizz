<?php

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Sleep;
use Phizz\Enums\Platform;
use Phizz\Retry;
use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\Support\HttpClient;
use Phizz\Support\RequestObject;

function makeHttpClient(array $responses, bool $cacheEnabled = false, int $timeout = 10): HttpClient
{
    config()->set('phizz.cache.enabled', $cacheEnabled);
    config()->set('phizz.timeout', $timeout);

    $configuration = new Configuration(app()['config'], app()['cache']->store());
    $cache = new Cache($configuration);
    $mock = new MockHandler($responses);
    $guzzle = new Guzzle(['handler' => HandlerStack::create($mock)]);

    return new HttpClient($configuration, $cache, $guzzle);
}

function makeRequest(array $overrides = []): RequestObject
{
    return new RequestObject(
        method: $overrides['method'] ?? 'GET',
        platform: $overrides['platform'] ?? 'na1',
        platformType: $overrides['platformType'] ?? Platform::class,
        endpoint: $overrides['endpoint'] ?? '/lol/summoner/v4/summoners/{id}',
        pathParams: $overrides['pathParams'] ?? ['id' => 'abc123'],
        queryParams: $overrides['queryParams'] ?? [],
        cacheKey: $overrides['cacheKey'] ?? 'lol.summonerV4.getById',
        returns: $overrides['returns'] ?? true,
        returnType: $overrides['returnType'] ?? null,
        collectionType: $overrides['collectionType'] ?? null,
        force: $overrides['force'] ?? false,
    );
}

it('returns decoded json from a successful response', function () {
    $client = makeHttpClient([
        new Response(200, [], json_encode(['id' => 'abc', 'name' => 'Faker'])),
    ]);

    $result = $client->request(makeRequest());

    expect($result)->toBe(['id' => 'abc', 'name' => 'Faker']);
});

it('returns null when the request declares no return value', function () {
    $client = makeHttpClient([
        new Response(204, [], ''),
    ]);

    $result = $client->request(makeRequest(['returns' => false, 'method' => 'POST']));

    expect($result)->toBeNull();
});

it('sends the api key as the X-Riot-Token header', function () {
    $history = [];
    $mock = new MockHandler([new Response(200, [], '{}')]);
    $stack = HandlerStack::create($mock);
    $stack->push(GuzzleHttp\Middleware::history($history));

    config()->set('phizz.api_key', 'RGAPI-test-key');
    config()->set('phizz.timeout', 10);
    $configuration = new Configuration(app()['config'], app()['cache']->store());
    $cache = new Cache($configuration);
    $guzzle = new Guzzle(['handler' => $stack]);
    $client = new HttpClient($configuration, $cache, $guzzle);

    $client->request(makeRequest());

    expect($history[0]['request']->getHeaderLine('X-Riot-Token'))->toBe('RGAPI-test-key');
});

it('serves a GET response from cache on the second call', function () {
    $client = makeHttpClient(
        [new Response(200, [], json_encode(['cached' => true]))],
        cacheEnabled: true,
    );

    $request = makeRequest();
    $first = $client->request($request);
    $second = $client->request($request); // no second mock response — must come from cache

    expect($first)->toBe($second);
});

it('does not cache non-GET responses', function () {
    $client = makeHttpClient([
        new Response(200, [], json_encode(['a' => 1])),
        new Response(200, [], json_encode(['a' => 2])),
    ], cacheEnabled: true);

    $first = $client->request(makeRequest(['method' => 'POST']));
    $second = $client->request(makeRequest(['method' => 'POST']));

    expect($first)->toBe(['a' => 1])
        ->and($second)->toBe(['a' => 2]);
});

it('retries once on a 429 and returns the successful response', function () {
    Sleep::fake();

    $client = makeHttpClient([
        new Response(429, ['Retry-After' => '1'], ''),
        new Response(200, [], json_encode(['ok' => true])),
    ]);

    $result = $client->request(makeRequest());

    expect($result)->toBe(['ok' => true]);
    Sleep::assertSleptTimes(1);
});

it('uses the Retry-After header value as the sleep duration', function () {
    Sleep::fake();

    $client = makeHttpClient([
        new Response(429, ['Retry-After' => '5'], ''),
        new Response(200, [], '{}'),
    ]);

    $client->request(makeRequest());

    Sleep::assertSlept(fn ($d) => $d->totalSeconds === 5);
});

it('falls back to the retry strategy when Retry-After is absent', function () {
    Sleep::fake();

    config()->set('phizz.retry.strategy', Retry::fixed(3));
    $client = makeHttpClient([
        new Response(429, [], ''),
        new Response(200, [], '{}'),
    ]);

    $client->request(makeRequest());

    Sleep::assertSlept(fn ($d) => $d->totalSeconds === 3);
});

it('throws a ClientException on non-429 errors', function () {
    $client = makeHttpClient([
        new Response(404, [], '{"status":{"message":"Not found"}}'),
    ]);

    $client->request(makeRequest());
})->throws(ClientException::class);

it('throws after the timeout is exceeded on a 429', function () {
    Sleep::fake();

    // timeout=0 means any elapsed time satisfies (elapsed >= timeout), so the first 429 is rethrown
    $client = makeHttpClient([
        new Response(429, ['Retry-After' => '1'], ''),
    ], timeout: 0);

    $client->request(makeRequest());
})->throws(ClientException::class);

it('bypasses cache and hits the network when force is true', function () {
    $client = makeHttpClient([
        new Response(200, [], json_encode(['v' => 1])),
        new Response(200, [], json_encode(['v' => 2])),
    ], cacheEnabled: true);

    $first = $client->request(makeRequest(['force' => true]));
    $second = $client->request(makeRequest(['force' => true]));

    expect($first)->toBe(['v' => 1])
        ->and($second)->toBe(['v' => 2]);
});

it('serves from cache on the second call when force is false', function () {
    $client = makeHttpClient(
        [new Response(200, [], json_encode(['v' => 1]))],
        cacheEnabled: true,
    );

    $first = $client->request(makeRequest(['force' => false]));
    $second = $client->request(makeRequest(['force' => false]));

    expect($first)->toBe(['v' => 1])
        ->and($second)->toBe(['v' => 1]);
});

it('force=true on a cached request still returns the live response after a cached entry exists', function () {
    $client = makeHttpClient([
        new Response(200, [], json_encode(['v' => 'cached'])),
        new Response(200, [], json_encode(['v' => 'fresh'])),
    ], cacheEnabled: true);

    // prime the cache
    $client->request(makeRequest(['force' => false]));

    // force bypasses the cached entry
    $result = $client->request(makeRequest(['force' => true]));

    expect($result)->toBe(['v' => 'fresh']);
});
