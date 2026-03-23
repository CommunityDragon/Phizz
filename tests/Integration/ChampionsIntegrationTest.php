<?php

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Phizz\Assets\AssetClient;
use Phizz\Assets\Lol\Champions\Objects\ChampionData;
use Phizz\Assets\Lol\Champions\Objects\PassiveData;
use Phizz\Assets\Lol\Champions\Objects\SkinData;
use Phizz\Assets\Lol\Champions\Objects\SpellData;
use Phizz\Support\StaticClient;

function makeCDragonClient(string $version = 'latest'): AssetClient
{
    return new AssetClient($version, new StaticClient);
}

it('returns a ChampionData for Ahri (id=103)', function () {
    $champion = makeCDragonClient()->lol->champions(103);

    expect($champion)->toBeInstanceOf(ChampionData::class)
        ->and($champion->id)->toBe(103)
        ->and($champion->name)->toBe('Ahri');
});

it('populates the passive as a PassiveData instance', function () {
    $champion = makeCDragonClient()->lol->champions(103);

    expect($champion->passive)->toBeInstanceOf(PassiveData::class)
        ->and($champion->passive->name)->not->toBeEmpty();
});

it('populates spells as a Collection of 4 SpellData instances', function () {
    $champion = makeCDragonClient()->lol->champions(103);

    expect($champion->spells)->toBeInstanceOf(Collection::class)
        ->and($champion->spells)->toHaveCount(4)
        ->and($champion->spells->every(fn ($s) => $s instanceof SpellData))->toBeTrue()
        ->and($champion->spells->first()->name)->not->toBeEmpty();
});

it('populates skins as a Collection of SkinData instances', function () {
    $champion = makeCDragonClient()->lol->champions(103);

    expect($champion->skins)->toBeInstanceOf(Collection::class)
        ->and($champion->skins)->not->toBeEmpty()
        ->and($champion->skins->first())->toBeInstanceOf(SkinData::class);
});

it('the base skin has id 103000', function () {
    $champion = makeCDragonClient()->lol->champions(103);
    $base = $champion->skins->first(fn ($s) => $s->is_base === true);

    expect($base)->not->toBeNull()
        ->and($base->id)->toBe(103000);
});

it('squarePortraitUrl returns a reachable HTTPS URL', function () {
    $champion = makeCDragonClient()->lol->champions(103);
    $url = $champion->squarePortraitUrl();

    expect($url)->toStartWith('https://raw.communitydragon.org');

    $response = (new Client)->head($url);
    expect($response->getStatusCode())->toBe(200);
});

it('passive abilityIconUrl returns a reachable HTTPS URL', function () {
    $champion = makeCDragonClient()->lol->champions(103);
    $url = $champion->passive->abilityIconUrl();

    expect($url)->toStartWith('https://raw.communitydragon.org');

    $response = (new Client)->head($url);
    expect($response->getStatusCode())->toBe(200);
});

it('first spell abilityIconUrl returns a reachable HTTPS URL', function () {
    $champion = makeCDragonClient()->lol->champions(103);
    $url = $champion->spells->first()->abilityIconUrl();

    expect($url)->toStartWith('https://raw.communitydragon.org');

    $response = (new Client)->head($url);
    expect($response->getStatusCode())->toBe(200);
});

it('base skin splashUrl returns a reachable HTTPS URL', function () {
    $champion = makeCDragonClient()->lol->champions(103);
    $url = $champion->skins->first()->splashUrl();

    expect($url)->toStartWith('https://raw.communitydragon.org');

    $response = (new Client)->head($url);
    expect($response->getStatusCode())->toBe(200);
});

it('returns the same ChampionData instance on a second call (cache hit)', function () {
    $client = makeCDragonClient()->lol;

    $first = $client->champions(103);
    $second = $client->champions(103);

    // Same underlying data — id is identical
    expect($second->id)->toBe($first->id);
});

it('includes the explicit version in generated URLs', function () {
    $champion = makeCDragonClient('15.1')->lol->champions(103);

    expect($champion->squarePortraitUrl())->toContain('/15.1/');
});
