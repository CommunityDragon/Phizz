<?php

namespace Phizz\Apis\Riot\AccountV1;

use Phizz\Apis\Riot\AccountV1\Objects\AccountData;
use Phizz\Apis\Riot\AccountV1\Objects\AccountRegionData;
use Phizz\Apis\Riot\AccountV1\Objects\ActiveShardData;
use Phizz\Cache\Riot\AccountV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class AccountV1Api extends Api
{
    /**
     * @returns AccountData
     */
    public function getByPuuid(string $puuid, Regional|Platform|string|null $platform = null, bool $force = false): AccountData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/accounts/by-puuid/{puuid}',
            cacheKey: AccountV1Ttl::getByPuuid,
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns AccountData
     */
    public function getByRiotId(
        string $tagLine,
        string $gameName,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): AccountData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/accounts/by-riot-id/{gameName}/{tagLine}',
            cacheKey: AccountV1Ttl::getByRiotId,
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
            pathParams: [
                'tagLine' => $tagLine,
                'gameName' => $gameName,
            ],
            force: $force,
        );
    }

    /**
     * @returns AccountData
     */
    public function getByAccessToken(Regional|Platform|string|null $platform = null, bool $force = false): AccountData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/accounts/me',
            cacheKey: AccountV1Ttl::getByAccessToken,
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
            force: $force,
        );
    }

    /**
     * @returns ActiveShardData
     */
    public function getActiveShard(
        string $game,
        string $puuid,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): ActiveShardData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/active-shards/by-game/{game}/by-puuid/{puuid}',
            cacheKey: AccountV1Ttl::getActiveShard,
            returns: true,
            platformType: Regional::class,
            returnType: ActiveShardData::class,
            platform: $platform,
            pathParams: [
                'game' => $game,
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns AccountRegionData
     */
    public function getActiveRegion(
        string $puuid,
        string $game,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): AccountRegionData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/region/by-game/{game}/by-puuid/{puuid}',
            cacheKey: AccountV1Ttl::getActiveRegion,
            returns: true,
            platformType: Regional::class,
            returnType: AccountRegionData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
                'game' => $game,
            ],
            force: $force,
        );
    }
}
