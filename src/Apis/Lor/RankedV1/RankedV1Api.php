<?php

namespace Phizz\Apis\Lor\RankedV1;

use Phizz\Apis\Lor\RankedV1\Objects\LeaderboardData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class RankedV1Api extends Api
{
    /**
     * @returns LeaderboardData
     */
    public function getLeaderboards(Regional|Platform|string|null $platform = null): LeaderboardData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/ranked/v1/leaderboards',
            returns: true,
            platformType: Regional::class,
            returnType: LeaderboardData::class,
            platform: $platform,
        );
    }
}
