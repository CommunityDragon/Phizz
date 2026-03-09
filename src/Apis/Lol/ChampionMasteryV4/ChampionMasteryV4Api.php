<?php

namespace Phizz\Apis\Lol\ChampionMasteryV4;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ChampionMasteryV4\Objects\ChampionMasteryData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChampionMasteryV4Api extends Api
{
    /**
     * @returns Collection<int, ChampionMasteryData>
     */
    public function getAllChampionMasteriesByPuuid(string $encryptedPuuid, Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/champion-mastery/v4/champion-masteries/by-puuid/$encryptedPuuid",
            returns: true,
            platformType: Platform::class,
            collectionType: ChampionMasteryData::class,
            platform: $platform,
        );
    }

    /**
     * @returns ChampionMasteryData
     */
    public function getChampionMasteryByPuuid(
        string $encryptedPuuid,
        int $championId,
        Platform|string|null $platform = null,
    ): ChampionMasteryData {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/champion-mastery/v4/champion-masteries/by-puuid/$encryptedPuuid/by-champion/$championId",
            returns: true,
            platformType: Platform::class,
            returnType: ChampionMasteryData::class,
            platform: $platform,
        );
    }

    /**
     * @returns Collection<int, ChampionMasteryData>
     */
    public function getTopChampionMasteriesByPuuid(
        string $encryptedPuuid,
        ?int $count = null,
        Platform|string|null $platform = null,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/champion-mastery/v4/champion-masteries/by-puuid/$encryptedPuuid/top",
            returns: true,
            platformType: Platform::class,
            collectionType: ChampionMasteryData::class,
            platform: $platform,
            query: [
                'count' => $count,
            ],
        );
    }

    /**
     * @returns int
     */
    public function getChampionMasteryScoreByPuuid(string $encryptedPuuid, Platform|string|null $platform = null): int
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/champion-mastery/v4/scores/by-puuid/$encryptedPuuid",
            returns: true,
            platformType: Platform::class,
            platform: $platform,
        );
    }
}
