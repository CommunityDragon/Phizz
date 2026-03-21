<?php

use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Exceptions\InvalidPlatformException;
use Phizz\Support\Api;
use Phizz\Support\Configuration;
use Phizz\Support\HttpClient;
use Phizz\Support\RequestObject;

// Concrete Api subclass that exposes fetch() publicly for testing.
class TestApi extends Api
{
    public function call(
        string $method,
        string $endpoint,
        string $cacheKey,
        bool $returns,
        string $platformType,
        ?string $returnType = null,
        ?string $collectionType = null,
        mixed $platform = null,
        array $platforms = [],
        array $pathParams = [],
        array $query = [],
        bool $force = false,
    ): mixed {
        return $this->fetch(
            method: $method,
            endpoint: $endpoint,
            cacheKey: $cacheKey,
            returns: $returns,
            platformType: $platformType,
            returnType: $returnType,
            collectionType: $collectionType,
            platform: $platform,
            platforms: $platforms,
            pathParams: $pathParams,
            query: $query,
            force: $force,
        );
    }
}

beforeEach(function () {
    $configuration = new Configuration(
        $this->app['config'],
        $this->app['cache']->store(),
    );

    $this->httpClient = $this->mock(HttpClient::class);

    $this->api = new TestApi($configuration, $this->httpClient);
});

it('passes a correctly built RequestObject to the http client', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(function (RequestObject $request): bool {
            return $request->method === 'GET'
                && $request->platform === 'na1'
                && $request->endpoint === '/lol/summoner/v4/summoners/{id}'
                && $request->pathParams === ['id' => 'abc']
                && $request->cacheKey === 'lol.summonerV4.getById'
                && $request->returns === true;
        })
        ->andReturn(['id' => 'abc']);

    $this->api->call(
        method: 'GET',
        endpoint: '/lol/summoner/v4/summoners/{id}',
        cacheKey: 'lol.summonerV4.getById',
        returns: true,
        platformType: Platform::class,
        pathParams: ['id' => 'abc'],
    );
});

it('resolves the platform from config when no override is given', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(fn (RequestObject $r) => $r->platform === 'na1')
        ->andReturn(null);

    $this->api->call('GET', '/test', 'key', true, Platform::class);
});

it('uses a per-request platform override', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(fn (RequestObject $r) => $r->platform === 'euw1')
        ->andReturn(null);

    $this->api->call('GET', '/test', 'key', true, Platform::class, platform: Platform::EUW);
});

it('converts a Platform to its Regional equivalent for regional endpoints', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(fn (RequestObject $r) => $r->platform === 'americas')
        ->andReturn(null);

    $this->api->call('GET', '/lol/match/v5/matches', 'key', true, Regional::class, platform: Platform::NA);
});

it('returns whatever the http client returns', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->andReturn(['result' => 'data']);

    $result = $this->api->call('GET', '/test', 'key', true, Platform::class);

    expect($result)->toBe(['result' => 'data']);
});

it('throws when the platform type does not match the endpoint expectation', function () {
    $this->api->call('GET', '/test', 'key', true, Regional::class, platform: ValPlatform::NA);
})->throws(InvalidPlatformException::class);

it('passes force=true to the RequestObject when force is requested', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(fn (RequestObject $r) => $r->force === true)
        ->andReturn(null);

    $this->api->call('GET', '/test', 'key', true, Platform::class, force: true);
});

it('passes force=false to the RequestObject by default', function () {
    $this->httpClient
        ->shouldReceive('request')
        ->once()
        ->withArgs(fn (RequestObject $r) => $r->force === false)
        ->andReturn(null);

    $this->api->call('GET', '/test', 'key', true, Platform::class);
});
