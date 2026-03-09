<?php

namespace Phizz\Apis\Lol\ChallengesV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ChallengesV1\Objects\ApexPlayerInfoData;
use Phizz\Apis\Lol\ChallengesV1\Objects\ChallengeConfigInfoData;
use Phizz\Apis\Lol\ChallengesV1\Objects\PlayerInfoData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChallengesV1Api extends Api
{
    /**
     * @returns Collection<int, ChallengeConfigInfoData>
     */
    public function getAllChallengeConfigs(Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/config',
            returns: true,
            platformType: Platform::class,
            collectionType: ChallengeConfigInfoData::class,
            platform: $platform,
        );
    }

    /**
     * @returns array
     */
    public function getAllChallengePercentiles(Platform|string|null $platform = null): array
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/percentiles',
            returns: true,
            platformType: Platform::class,
            platform: $platform,
        );
    }

    /**
     * @returns ChallengeConfigInfoData
     */
    public function getChallengeConfigs(int $challengeId, Platform|string|null $platform = null): ChallengeConfigInfoData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/challenges/v1/challenges/$challengeId/config",
            returns: true,
            platformType: Platform::class,
            returnType: ChallengeConfigInfoData::class,
            platform: $platform,
        );
    }

    /**
     * @returns Collection<int, ApexPlayerInfoData>
     */
    public function getChallengeLeaderboards(
        string $level,
        int $challengeId,
        ?int $limit = null,
        Platform|string|null $platform = null,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/challenges/v1/challenges/$challengeId/leaderboards/by-level/$level",
            returns: true,
            platformType: Platform::class,
            collectionType: ApexPlayerInfoData::class,
            platform: $platform,
            query: [
                'limit' => $limit,
            ],
        );
    }

    /**
     * @returns array
     */
    public function getChallengePercentiles(int $challengeId, Platform|string|null $platform = null): array
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/challenges/v1/challenges/$challengeId/percentiles",
            returns: true,
            platformType: Platform::class,
            platform: $platform,
        );
    }

    /**
     * @returns PlayerInfoData
     */
    public function getPlayerData(string $puuid, Platform|string|null $platform = null): PlayerInfoData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/challenges/v1/player-data/$puuid",
            returns: true,
            platformType: Platform::class,
            returnType: PlayerInfoData::class,
            platform: $platform,
        );
    }
}
