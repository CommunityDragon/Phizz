<?php

namespace Phizz\Apis\Lol\ChampionMasteryV4;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ChampionMasteryV4\Objects\ChampionMasteryData;
use Phizz\Cache\Lol\ChampionMasteryV4Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChampionMasteryV4Api extends Api
{
    /**
     * @returns Collection<int, ChampionMasteryData>
     */
    public function getAllChampionMasteriesByPuuid(
        string $encryptedPuuid,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/champion-mastery/v4/champion-masteries/by-puuid/{encryptedPUUID}',
            cacheKey: ChampionMasteryV4Ttl::getAllChampionMasteriesByPuuid,
            returns: true,
            platformType: Platform::class,
            collectionType: ChampionMasteryData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns ChampionMasteryData
     */
    public function getChampionMasteryByPuuid(
        string $encryptedPuuid,
        int $championId,
        Platform|string|null $platform = null,
        bool $force = false,
    ): ChampionMasteryData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/champion-mastery/v4/champion-masteries/by-puuid/{encryptedPUUID}/by-champion/{championId}',
            cacheKey: ChampionMasteryV4Ttl::getChampionMasteryByPuuid,
            returns: true,
            platformType: Platform::class,
            returnType: ChampionMasteryData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
                'championId' => $championId,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, ChampionMasteryData>
     */
    public function getTopChampionMasteriesByPuuid(
        string $encryptedPuuid,
        ?int $count = null,
        Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/champion-mastery/v4/champion-masteries/by-puuid/{encryptedPUUID}/top',
            cacheKey: ChampionMasteryV4Ttl::getTopChampionMasteriesByPuuid,
            returns: true,
            platformType: Platform::class,
            collectionType: ChampionMasteryData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            query: [
                'count' => $count,
            ],
            force: $force,
        );
    }

    /**
     * @returns int
     */
    public function getChampionMasteryScoreByPuuid(
        string $encryptedPuuid,
        Platform|string|null $platform = null,
        bool $force = false,
    ): int {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/champion-mastery/v4/scores/by-puuid/{encryptedPUUID}',
            cacheKey: ChampionMasteryV4Ttl::getChampionMasteryScoreByPuuid,
            returns: true,
            platformType: Platform::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            force: $force,
        );
    }
}
