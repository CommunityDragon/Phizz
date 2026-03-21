<?php

use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\TTL;

it('resolves a three-level TTL chain to the correct cache key string', function () {
    expect(TTL::lol::matchV5::getMatch)->toBe('lol.matchV5.getMatch');
});

it('resolves every game namespace to the correct prefix', function () {
    expect(TTL::riot::accountV1::getByPuuid)->toStartWith('riot.')
        ->and(TTL::lol::matchV5::getMatch)->toStartWith('lol.')
        ->and(TTL::tft::matchV1::getMatch)->toStartWith('tft.')
        ->and(TTL::lor::matchV1::getMatch)->toStartWith('lor.')
        ->and(TTL::val::matchV1::getMatch)->toStartWith('val.')
        ->and(TTL::riftbound::contentV1::getContent)->toStartWith('riftbound.');
});

it('produces unique keys across different apis within the same game', function () {
    $keys = [
        TTL::lol::matchV5::getMatch,
        TTL::lol::leagueV4::getLeagueById,
        TTL::lol::summonerV4::getByPuuid,
        TTL::lol::spectatorV5::getCurrentGameInfoByPuuid,
    ];

    expect($keys)->toHaveCount(count(array_unique($keys)));
});

it('produces unique keys for the same method name across different games', function () {
    $getMatch = [
        TTL::lol::matchV5::getMatch,
        TTL::tft::matchV1::getMatch,
        TTL::lor::matchV1::getMatch,
        TTL::val::matchV1::getMatch,
    ];

    expect($getMatch)->toHaveCount(count(array_unique($getMatch)));
});

it('config assigns 86400s to immutable match endpoints', function () {
    $method = require __DIR__.'/../../config/phizz.php';
    $method = $method['cache']['method'];

    expect($method[TTL::lol::matchV5::getMatch])->toBe(86400)
        ->and($method[TTL::lol::matchV5::getTimeline])->toBe(86400)
        ->and($method[TTL::tft::matchV1::getMatch])->toBe(86400)
        ->and($method[TTL::lor::matchV1::getMatch])->toBe(86400)
        ->and($method[TTL::val::matchV1::getMatch])->toBe(86400);
});

it('config assigns 3600s to summoner and account lookups', function () {
    $method = require __DIR__.'/../../config/phizz.php';
    $method = $method['cache']['method'];

    expect($method[TTL::riot::accountV1::getByPuuid])->toBe(3600)
        ->and($method[TTL::riot::accountV1::getByRiotId])->toBe(3600)
        ->and($method[TTL::lol::summonerV4::getByPuuid])->toBe(3600)
        ->and($method[TTL::tft::summonerV1::getByPuuid])->toBe(3600);
});

it('config assigns 300s to ranking and match list endpoints', function () {
    $method = require __DIR__.'/../../config/phizz.php';
    $method = $method['cache']['method'];

    expect($method[TTL::lol::matchV5::getMatchIdsByPuuid])->toBe(300)
        ->and($method[TTL::lol::leagueV4::getChallengerLeague])->toBe(300)
        ->and($method[TTL::lol::leagueV4::getMasterLeague])->toBe(300)
        ->and($method[TTL::tft::leagueV1::getTopRatedLadder])->toBe(300);
});

it('config assigns 30s to live spectator endpoints', function () {
    $method = require __DIR__.'/../../config/phizz.php';
    $method = $method['cache']['method'];

    expect($method[TTL::lol::spectatorV5::getCurrentGameInfoByPuuid])->toBe(30)
        ->and($method[TTL::tft::spectatorV5::getCurrentGameInfoByPuuid])->toBe(30);
});

it('config assigns 600s to clash tournament and tournament game endpoints', function () {
    $method = require __DIR__.'/../../config/phizz.php';
    $method = $method['cache']['method'];

    expect($method[TTL::lol::clashV1::getTournaments])->toBe(600)
        ->and($method[TTL::lol::clashV1::getTournamentById])->toBe(600)
        ->and($method[TTL::lol::tournamentV5::getGames])->toBe(600);
});

it('cache uses the ttl constant string as the lookup key', function () {
    config()->set('phizz.cache.enabled', true);
    config()->set('phizz.cache.method', [
        TTL::lol::matchV5::getMatch => 86400,
    ]);

    $configuration = new Configuration($this->app['config'], $this->app['cache']->store());
    $cache = new Cache($configuration);

    $calls = 0;
    $cache->remember(TTL::lol::matchV5::getMatch, TTL::lol::matchV5::getMatch, [], [], function () use (&$calls) {
        $calls++;

        return 'match-data';
    });

    $result = $cache->remember(TTL::lol::matchV5::getMatch, TTL::lol::matchV5::getMatch, [], [], function () use (&$calls) {
        $calls++;

        return 'should-not-be-called';
    });

    expect($calls)->toBe(1)
        ->and($result)->toBe('match-data');
});

it('cache applies different method ttls to different endpoints', function () {
    config()->set('phizz.cache.enabled', true);
    config()->set('phizz.cache.method', [
        TTL::lol::matchV5::getMatch => 86400,
        TTL::lol::spectatorV5::getCurrentGameInfoByPuuid => 30,
    ]);

    $configuration = new Configuration($this->app['config'], $this->app['cache']->store());

    expect($configuration->methodTTLs[TTL::lol::matchV5::getMatch])->toBe(86400)
        ->and($configuration->methodTTLs[TTL::lol::spectatorV5::getCurrentGameInfoByPuuid])->toBe(30);
});
