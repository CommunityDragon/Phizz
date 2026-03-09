<?php

namespace Phizz\Apis\Lol\MatchV5;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\MatchV5\Objects\MatchData;
use Phizz\Apis\Lol\MatchV5\Objects\ReplayData;
use Phizz\Apis\Lol\MatchV5\Objects\TimelineData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class MatchV5Api extends Api
{
    /**
     * @returns Collection<int, string>
     */
    public function getMatchIdsByPuuid(
        string $puuid,
        ?int $startTime = null,
        ?int $endTime = null,
        ?int $queue = null,
        ?string $type = null,
        ?int $start = null,
        ?int $count = null,
        Regional|Platform|string|null $platform = null,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/match/v5/matches/by-puuid/$puuid/ids",
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            query: [
                'startTime' => $startTime,
                'endTime' => $endTime,
                'queue' => $queue,
                'type' => $type,
                'start' => $start,
                'count' => $count,
            ],
        );
    }

    /**
     * @returns ReplayData
     */
    public function getReplay(string $puuid, Regional|Platform|string|null $platform = null): ReplayData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/match/v5/matches/by-puuid/$puuid/replays",
            returns: true,
            platformType: Regional::class,
            returnType: ReplayData::class,
            platform: $platform,
        );
    }

    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, Regional|Platform|string|null $platform = null): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/match/v5/matches/$matchId",
            returns: true,
            platformType: Regional::class,
            returnType: MatchData::class,
            platform: $platform,
        );
    }

    /**
     * @returns TimelineData
     */
    public function getTimeline(string $matchId, Regional|Platform|string|null $platform = null): TimelineData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/match/v5/matches/$matchId/timeline",
            returns: true,
            platformType: Regional::class,
            returnType: TimelineData::class,
            platform: $platform,
        );
    }
}
