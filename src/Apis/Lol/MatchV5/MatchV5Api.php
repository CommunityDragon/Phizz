<?php

namespace Phizz\Apis\Lol\MatchV5;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\MatchV5\Objects\MatchData;
use Phizz\Apis\Lol\MatchV5\Objects\ReplayData;
use Phizz\Apis\Lol\MatchV5\Objects\TimelineData;
use Phizz\Cache\Lol\MatchV5Ttl;
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
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/match/v5/matches/by-puuid/{puuid}/ids',
            cacheKey: MatchV5Ttl::getMatchIdsByPuuid,
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            query: [
                'startTime' => $startTime,
                'endTime' => $endTime,
                'queue' => $queue,
                'type' => $type,
                'start' => $start,
                'count' => $count,
            ],
            force: $force,
        );
    }

    /**
     * @returns ReplayData
     */
    public function getReplay(string $puuid, Regional|Platform|string|null $platform = null, bool $force = false): ReplayData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/match/v5/matches/by-puuid/{puuid}/replays',
            cacheKey: MatchV5Ttl::getReplay,
            returns: true,
            platformType: Regional::class,
            returnType: ReplayData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, Regional|Platform|string|null $platform = null, bool $force = false): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/match/v5/matches/{matchId}',
            cacheKey: MatchV5Ttl::getMatch,
            returns: true,
            platformType: Regional::class,
            returnType: MatchData::class,
            platform: $platform,
            pathParams: [
                'matchId' => $matchId,
            ],
            force: $force,
        );
    }

    /**
     * @returns TimelineData
     */
    public function getTimeline(
        string $matchId,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): TimelineData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/match/v5/matches/{matchId}/timeline',
            cacheKey: MatchV5Ttl::getTimeline,
            returns: true,
            platformType: Regional::class,
            returnType: TimelineData::class,
            platform: $platform,
            pathParams: [
                'matchId' => $matchId,
            ],
            force: $force,
        );
    }
}
