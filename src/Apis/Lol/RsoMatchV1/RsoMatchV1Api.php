<?php

namespace Phizz\Apis\Lol\RsoMatchV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\MatchV5\Objects\MatchData;
use Phizz\Apis\Lol\MatchV5\Objects\TimelineData;
use Phizz\Cache\Lol\RsoMatchV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class RsoMatchV1Api extends Api
{
    /**
     * @returns Collection<int, string>
     */
    public function getMatchIds(
        ?int $count = null,
        ?int $start = null,
        ?string $type = null,
        ?int $queue = null,
        ?int $endTime = null,
        ?int $startTime = null,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/rso-match/v1/matches/ids',
            cacheKey: RsoMatchV1Ttl::getMatchIds,
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            query: [
                'count' => $count,
                'start' => $start,
                'type' => $type,
                'queue' => $queue,
                'endTime' => $endTime,
                'startTime' => $startTime,
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
            endpoint: '/lol/rso-match/v1/matches/{matchId}',
            cacheKey: RsoMatchV1Ttl::getMatch,
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
            endpoint: '/lol/rso-match/v1/matches/{matchId}/timeline',
            cacheKey: RsoMatchV1Ttl::getTimeline,
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
