<?php

namespace Phizz\Apis\Val\ConsoleMatchV1;

use Phizz\Apis\Val\ConsoleMatchV1\Objects\MatchData;
use Phizz\Apis\Val\ConsoleMatchV1\Objects\MatchlistData;
use Phizz\Apis\Val\ConsoleMatchV1\Objects\RecentMatchesData;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class ConsoleMatchV1Api extends Api
{
    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, ValPlatform|string|null $platform = null): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/console/v1/matches/$matchId",
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchData::class,
            platform: $platform,
        );
    }

    /**
     * @returns MatchlistData
     */
    public function getMatchlist(string $puuid, string $platformType, ValPlatform|string|null $platform = null): MatchlistData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/console/v1/matchlists/by-puuid/$puuid",
            returns: true,
            platformType: ValPlatform::class,
            returnType: MatchlistData::class,
            platform: $platform,
            query: [
                'platformType' => $platformType,
            ],
        );
    }

    /**
     * @returns RecentMatchesData
     */
    public function getRecent(string $queue, ValPlatform|string|null $platform = null): RecentMatchesData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/match/console/v1/recent-matches/by-queue/$queue",
            returns: true,
            platformType: ValPlatform::class,
            returnType: RecentMatchesData::class,
            platform: $platform,
        );
    }
}
