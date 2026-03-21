<?php

namespace Phizz\Apis\Tft\LeagueV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Tft\LeagueV1\Objects\LeagueEntryData;
use Phizz\Apis\Tft\LeagueV1\Objects\LeagueListData;
use Phizz\Apis\Tft\LeagueV1\Objects\TopRatedLadderEntryData;
use Phizz\Cache\Tft\LeagueV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class LeagueV1Api extends Api
{
    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntriesByPuuid(
        string $puuid,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/by-puuid/{puuid}',
            cacheKey: LeagueV1Ttl::getLeagueEntriesByPuuid,
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getChallengerLeague(
        ?string $queue = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): LeagueListData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/challenger',
            cacheKey: LeagueV1Ttl::getChallengerLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntries(
        string $tier,
        string $division,
        ?string $queue = null,
        ?int $page = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/entries/{tier}/{division}',
            cacheKey: LeagueV1Ttl::getLeagueEntries,
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            pathParams: [
                'tier' => $tier,
                'division' => $division,
            ],
            query: [
                'queue' => $queue,
                'page' => $page,
            ],
            force: $force,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getGrandmasterLeague(
        ?string $queue = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): LeagueListData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/grandmaster',
            cacheKey: LeagueV1Ttl::getGrandmasterLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getLeagueById(string $leagueId, Platform|string|null $platform = null, bool $force = false): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/leagues/{leagueId}',
            cacheKey: LeagueV1Ttl::getLeagueById,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            pathParams: [
                'leagueId' => $leagueId,
            ],
            force: $force,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getMasterLeague(
        ?string $queue = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): LeagueListData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/master',
            cacheKey: LeagueV1Ttl::getMasterLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, TopRatedLadderEntryData>
     */
    public function getTopRatedLadder(string $queue, Platform|string|null $platform = null, bool $force = false): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/rated-ladders/{queue}/top',
            cacheKey: LeagueV1Ttl::getTopRatedLadder,
            returns: true,
            platformType: Platform::class,
            collectionType: TopRatedLadderEntryData::class,
            platform: $platform,
            pathParams: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }
}
