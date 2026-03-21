<?php

namespace Phizz\Apis\Val\MatchV1;

use Phizz\Apis\Val\MatchV1\Objects\MatchData;
use Phizz\Apis\Val\MatchV1\Objects\MatchlistData;
use Phizz\Apis\Val\MatchV1\Objects\RecentMatchesData;
use Phizz\Cache\Val\MatchV1Ttl;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class MatchV1Api extends Api
{
    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, ValPlatform|string|null $platform = null, bool $force = false): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/match/v1/matches/{matchId}',
            cacheKey: MatchV1Ttl::getMatch,
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
    public function getMatchlist(string $puuid, ValPlatform|string|null $platform = null, bool $force = false): MatchlistData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/match/v1/matchlists/by-puuid/{puuid}',
            cacheKey: MatchV1Ttl::getMatchlist,
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchlistData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
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
            endpoint: '/val/match/v1/recent-matches/by-queue/{queue}',
            cacheKey: MatchV1Ttl::getRecent,
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
