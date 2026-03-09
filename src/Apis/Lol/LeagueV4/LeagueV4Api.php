<?php

namespace Phizz\Apis\Lol\LeagueV4;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\LeagueV4\Objects\LeagueEntryData;
use Phizz\Apis\Lol\LeagueV4\Objects\LeagueListData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class LeagueV4Api extends Api
{
    /**
     * @returns LeagueListData
     */
    public function getChallengerLeague(string $queue, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/challengerleagues/by-queue/$queue",
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
        );
    }

    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntriesByPuuid(string $encryptedPuuid, Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/entries/by-puuid/$encryptedPuuid",
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
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
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/entries/$queue/$tier/$division",
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            query: [
                'page' => $page,
            ],
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getGrandmasterLeague(string $queue, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/grandmasterleagues/by-queue/$queue",
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getLeagueById(string $leagueId, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/leagues/$leagueId",
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getMasterLeague(string $queue, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league/v4/masterleagues/by-queue/$queue",
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
        );
    }
}
