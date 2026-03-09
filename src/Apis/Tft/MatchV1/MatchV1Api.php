<?php

namespace Phizz\Apis\Tft\MatchV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Tft\MatchV1\Objects\MatchData;
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
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/match/v1/matches/by-puuid/$puuid/ids",
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            query: [
                'start' => $start,
                'endTime' => $endTime,
                'startTime' => $startTime,
                'count' => $count,
            ],
        );
    }

    /**
     * @returns MatchData
     */
    public function getMatch(string $matchId, Regional|Platform|string|null $platform = null): MatchData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/match/v1/matches/$matchId",
            returns: true,
            platformType: Regional::class,
            returnType: MatchData::class,
            platform: $platform,
        );
    }
}
