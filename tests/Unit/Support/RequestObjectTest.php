<?php

use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\RequestObject;

it('builds a url with path params substituted', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/lol/match/v5/matches/{matchId}',
        pathParams: ['matchId' => 'NA1_123456789'],
    );

    expect($request->url())->toBe('https://na1.api.riotgames.com/lol/match/v5/matches/NA1_123456789');
});

it('builds a url without path params', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'europe',
        platformType: Regional::class,
        endpoint: '/lol/match/v5/matches',
    );

    expect($request->url())->toBe('https://europe.api.riotgames.com/lol/match/v5/matches');
});

it('substitutes multiple path params', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/lol/clash/v1/players/by-summoner/{summonerId}',
        pathParams: ['summonerId' => 'abc123'],
    );

    expect($request->url())->toBe('https://na1.api.riotgames.com/lol/clash/v1/players/by-summoner/abc123');
});

it('filters blank values from query params', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/test',
        queryParams: ['queue' => 420, 'season' => null, 'champion' => '', 'count' => 0],
    );

    expect($request->query())->toBe(['queue' => 420, 'count' => 0]);
});

it('returns all query params when none are blank', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/test',
        queryParams: ['queue' => 420, 'count' => 20],
    );

    expect($request->query())->toBe(['queue' => 420, 'count' => 20]);
});

it('is cacheable for GET requests', function () {
    $request = new RequestObject(
        method: 'GET',
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/test',
    );

    expect($request->cacheable())->toBeTrue();
});

it('is not cacheable for non-GET requests', function (string $method) {
    $request = new RequestObject(
        method: $method,
        platform: 'na1',
        platformType: Platform::class,
        endpoint: '/test',
    );

    expect($request->cacheable())->toBeFalse();
})->with(['POST', 'PUT', 'DELETE', 'PATCH']);
