<?php

namespace Phizz\Apis\Val\MatchV1;

use Phizz\Apis\Val\MatchV1\Objects\MatchData;
use Phizz\Apis\Val\MatchV1\Objects\MatchlistData;
use Phizz\Apis\Val\MatchV1\Objects\RecentMatchesData;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class MatchV1Api extends Api
{
    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, ValPlatform|string|null $platform = null): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/v1/matches/$matchId",
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchData::class,
            platform: $platform,
        );
    }

    /**
     * @returns MatchlistData
     */
    public function getMatchlist(string $puuid, ValPlatform|string|null $platform = null): MatchlistData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/v1/matchlists/by-puuid/$puuid",
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchlistData::class,
            platform: $platform,
        );
    }

    /**
     * @returns RecentMatchesData
     */
    public function getRecent(string $queue, ValPlatform|string|null $platform = null): RecentMatchesData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/v1/recent-matches/by-queue/$queue",
            returns: true,
            platformType: ValPlatform::class,
            returnType: RecentMatchesData::class,
            platform: $platform,
        );
    }
}
