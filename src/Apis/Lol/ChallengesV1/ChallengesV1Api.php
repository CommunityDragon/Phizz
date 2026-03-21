<?php

namespace Phizz\Apis\Lol\ChallengesV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ChallengesV1\Objects\ApexPlayerInfoData;
use Phizz\Apis\Lol\ChallengesV1\Objects\ChallengeConfigInfoData;
use Phizz\Apis\Lol\ChallengesV1\Objects\PlayerInfoData;
use Phizz\Cache\Lol\ChallengesV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChallengesV1Api extends Api
{
    /**
     * @returns Collection<int, ChallengeConfigInfoData>
     */
    public function getAllChallengeConfigs(Platform|string|null $platform = null, bool $force = false): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/config',
            cacheKey: ChallengesV1Ttl::getAllChallengeConfigs,
            returns: true,
            platformType: Platform::class,
            collectionType: ChallengeConfigInfoData::class,
            platform: $platform,
            force: $force,
        );
    }

    /**
     * @returns array
     */
    public function getAllChallengePercentiles(Platform|string|null $platform = null, bool $force = false): array
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/percentiles',
            cacheKey: ChallengesV1Ttl::getAllChallengePercentiles,
            returns: true,
            platformType: Platform::class,
            platform: $platform,
            force: $force,
        );
    }

    /**
     * @returns ChallengeConfigInfoData
     */
    public function getChallengeConfigs(
        int $challengeId,
        Platform|string|null $platform = null,
        bool $force = false,
    ): ChallengeConfigInfoData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/{challengeId}/config',
            cacheKey: ChallengesV1Ttl::getChallengeConfigs,
            returns: true,
            platformType: Platform::class,
            returnType: ChallengeConfigInfoData::class,
            platform: $platform,
            pathParams: [
                'challengeId' => $challengeId,
            ],
            force: $force,
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
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/{challengeId}/leaderboards/by-level/{level}',
            cacheKey: ChallengesV1Ttl::getChallengeLeaderboards,
            returns: true,
            platformType: Platform::class,
            collectionType: ApexPlayerInfoData::class,
            platform: $platform,
            pathParams: [
                'level' => $level,
                'challengeId' => $challengeId,
            ],
            query: [
                'limit' => $limit,
            ],
            force: $force,
        );
    }

    /**
     * @returns array
     */
    public function getChallengePercentiles(int $challengeId, Platform|string|null $platform = null, bool $force = false): array
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/challenges/{challengeId}/percentiles',
            cacheKey: ChallengesV1Ttl::getChallengePercentiles,
            returns: true,
            platformType: Platform::class,
            platform: $platform,
            pathParams: [
                'challengeId' => $challengeId,
            ],
            force: $force,
        );
    }

    /**
     * @returns PlayerInfoData
     */
    public function getPlayerData(string $puuid, Platform|string|null $platform = null, bool $force = false): PlayerInfoData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/challenges/v1/player-data/{puuid}',
            cacheKey: ChallengesV1Ttl::getPlayerData,
            returns: true,
            platformType: Platform::class,
            returnType: PlayerInfoData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }
}
