<?php

namespace Phizz\Apis\Val\ConsoleRankedV1;

use Phizz\Apis\Val\ConsoleRankedV1\Objects\LeaderboardData;
use Phizz\Cache\Val\ConsoleRankedV1Ttl;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class ConsoleRankedV1Api extends Api
{
    /**
     * @returns LeaderboardData
     */
    public function getLeaderboard(
        string $actId,
        ?int $startIndex,
        ?int $size,
        string $platformType,
        ValPlatform|string|null $platform = null,
        bool $force = false,
    ): LeaderboardData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/console/ranked/v1/leaderboards/by-act/{actId}',
            cacheKey: ConsoleRankedV1Ttl::getLeaderboard,
            returns: true,
            platformType: ValPlatform::class,
            returnType: LeaderboardData::class,
            platform: $platform,
            pathParams: [
                'actId' => $actId,
            ],
            query: [
                'startIndex' => $startIndex,
                'size' => $size,
                'platformType' => $platformType,
            ],
            force: $force,
        );
    }
}
