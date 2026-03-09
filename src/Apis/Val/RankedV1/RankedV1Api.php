<?php

namespace Phizz\Apis\Val\RankedV1;

use Phizz\Apis\Val\RankedV1\Objects\LeaderboardData;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class RankedV1Api extends Api
{
    /**
     * @returns LeaderboardData
     */
    public function getLeaderboard(
        string $actId,
        ?int $size = null,
        ?int $startIndex = null,
        ValPlatform|string|null $platform = null,
    ): LeaderboardData {
        return $this->fetch(
            method: 'GET',
            endpoint: "/val/ranked/v1/leaderboards/by-act/$actId",
            returns: true,
            platformType: ValPlatform::class,
            returnType: LeaderboardData::class,
            platform: $platform,
            query: [
                'size' => $size,
                'startIndex' => $startIndex,
            ],
        );
    }
}
