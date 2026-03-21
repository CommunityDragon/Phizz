<?php

namespace Phizz\Apis\Tft\MatchV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Tft\MatchV1\Objects\MatchData;
use Phizz\Cache\Tft\MatchV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class MatchV1Api extends Api
{
    /**
     * @returns Collection<int, string>
     */
    public function getMatchIdsByPuuid(
        string $puuid,
        ?int $start = null,
        ?int $endTime = null,
        ?int $startTime = null,
        ?int $count = null,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/match/v1/matches/by-puuid/{puuid}/ids',
            cacheKey: MatchV1Ttl::getMatchIdsByPuuid,
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            query: [
                'start' => $start,
                'endTime' => $endTime,
                'startTime' => $startTime,
                'count' => $count,
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
            endpoint: '/tft/match/v1/matches/{matchId}',
            cacheKey: MatchV1Ttl::getMatch,
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
}
