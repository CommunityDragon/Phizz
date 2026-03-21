<?php

namespace Phizz\Apis\Lol\LeagueV4;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\LeagueV4\Objects\LeagueEntryData;
use Phizz\Apis\Lol\LeagueV4\Objects\LeagueListData;
use Phizz\Cache\Lol\LeagueV4Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class LeagueV4Api extends Api
{
    /**
     * @returns LeagueListData
     */
    public function getChallengerLeague(
        string $queue,
        Platform|string|null $platform = null,
        bool $force = false,
    ): LeagueListData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/league/v4/challengerleagues/by-queue/{queue}',
            cacheKey: LeagueV4Ttl::getChallengerLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            pathParams: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntriesByPuuid(
        string $encryptedPuuid,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/league/v4/entries/by-puuid/{encryptedPUUID}',
            cacheKey: LeagueV4Ttl::getLeagueEntriesByPuuid,
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntries(
        string $division,
        string $tier,
        string $queue,
        ?int $page = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/league/v4/entries/{queue}/{tier}/{division}',
            cacheKey: LeagueV4Ttl::getLeagueEntries,
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            pathParams: [
                'division' => $division,
                'tier' => $tier,
                'queue' => $queue,
            ],
            query: [
                'page' => $page,
            ],
            force: $force,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getGrandmasterLeague(
        string $queue,
        Platform|string|null $platform = null,
        bool $force = false,
    ): LeagueListData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/league/v4/grandmasterleagues/by-queue/{queue}',
            cacheKey: LeagueV4Ttl::getGrandmasterLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            pathParams: [
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
            endpoint: '/lol/league/v4/leagues/{leagueId}',
            cacheKey: LeagueV4Ttl::getLeagueById,
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
    public function getMasterLeague(string $queue, Platform|string|null $platform = null, bool $force = false): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/league/v4/masterleagues/by-queue/{queue}',
            cacheKey: LeagueV4Ttl::getMasterLeague,
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            pathParams: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }
}
