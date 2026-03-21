<?php

namespace Phizz\Apis\Lor\MatchV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lor\MatchV1\Objects\MatchData;
use Phizz\Cache\Lor\MatchV1Ttl;
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
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/match/v1/matches/by-puuid/{puuid}/ids',
            cacheKey: MatchV1Ttl::getMatchIdsByPuuid,
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
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
            endpoint: '/lor/match/v1/matches/{matchId}',
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
