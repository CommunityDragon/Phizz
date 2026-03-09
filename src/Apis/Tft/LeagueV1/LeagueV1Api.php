<?php

namespace Phizz\Apis\Tft\LeagueV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Tft\LeagueV1\Objects\LeagueEntryData;
use Phizz\Apis\Tft\LeagueV1\Objects\LeagueListData;
use Phizz\Apis\Tft\LeagueV1\Objects\TopRatedLadderEntryData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class LeagueV1Api extends Api
{
    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntriesByPuuid(string $puuid, Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/league/v1/by-puuid/$puuid",
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getChallengerLeague(?string $queue = null, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/challenger',
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
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
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/league/v1/entries/$tier/$division",
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
                'page' => $page,
            ],
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getGrandmasterLeague(?string $queue = null, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/grandmaster',
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getLeagueById(string $leagueId, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/league/v1/leagues/$leagueId",
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
        );
    }

    /**
     * @returns LeagueListData
     */
    public function getMasterLeague(?string $queue = null, Platform|string|null $platform = null): LeagueListData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/league/v1/master',
            returns: true,
            platformType: Platform::class,
            returnType: LeagueListData::class,
            platform: $platform,
            query: [
                'queue' => $queue,
            ],
        );
    }

    /**
     * @returns Collection<int, TopRatedLadderEntryData>
     */
    public function getTopRatedLadder(string $queue, Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/league/v1/rated-ladders/$queue/top",
            returns: true,
            platformType: Platform::class,
            collectionType: TopRatedLadderEntryData::class,
            platform: $platform,
        );
    }
}
