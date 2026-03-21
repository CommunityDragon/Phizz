<?php

namespace Phizz\Apis\Val\ConsoleMatchV1;

use Phizz\Apis\Val\ConsoleMatchV1\Objects\MatchData;
use Phizz\Apis\Val\ConsoleMatchV1\Objects\MatchlistData;
use Phizz\Apis\Val\ConsoleMatchV1\Objects\RecentMatchesData;
use Phizz\Cache\Val\ConsoleMatchV1Ttl;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class ConsoleMatchV1Api extends Api
{
    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, ValPlatform|string|null $platform = null, bool $force = false): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/match/console/v1/matches/{matchId}',
            cacheKey: ConsoleMatchV1Ttl::getMatch,
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchData::class,
            platform: $platform,
            pathParams: [
                'matchId' => $matchId,
            ],
            force: $force,
        );
    }

    /**
     * @returns MatchlistData
     */
    public function getMatchlist(
        string $puuid,
        string $platformType,
        ValPlatform|string|null $platform = null,
        bool $force = false,
    ): MatchlistData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/match/console/v1/matchlists/by-puuid/{puuid}',
            cacheKey: ConsoleMatchV1Ttl::getMatchlist,
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchlistData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            query: [
                'platformType' => $platformType,
            ],
            force: $force,
        );
    }

    /**
     * @returns RecentMatchesData
     */
    public function getRecent(string $queue, ValPlatform|string|null $platform = null, bool $force = false): RecentMatchesData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/match/console/v1/recent-matches/by-queue/{queue}',
            cacheKey: ConsoleMatchV1Ttl::getRecent,
            returns: true,
            platformType: ValPlatform::class,
            returnType: RecentMatchesData::class,
            platform: $platform,
            pathParams: [
                'queue' => $queue,
            ],
            force: $force,
        );
    }
}
