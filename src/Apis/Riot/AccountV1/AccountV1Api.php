<?php

namespace Phizz\Apis\Riot\AccountV1;

use Phizz\Apis\Riot\AccountV1\Objects\AccountData;
use Phizz\Apis\Riot\AccountV1\Objects\AccountRegionData;
use Phizz\Apis\Riot\AccountV1\Objects\ActiveShardData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class AccountV1Api extends Api
{
    /**
     * @returns AccountData
     */
    public function getByPuuid(string $puuid, Regional|Platform|string|null $platform = null): AccountData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/riot/account/v1/accounts/by-puuid/$puuid",
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
        );
    }

    /**
     * @returns AccountData
     */
    public function getByRiotId(string $tagLine, string $gameName, Regional|Platform|string|null $platform = null): AccountData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/riot/account/v1/accounts/by-riot-id/$gameName/$tagLine",
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
        );
    }

    /**
     * @returns AccountData
     */
    public function getByAccessToken(Regional|Platform|string|null $platform = null): AccountData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riot/account/v1/accounts/me',
            returns: true,
            platformType: Regional::class,
            returnType: AccountData::class,
            platform: $platform,
        );
    }

    /**
     * @returns ActiveShardData
     */
    public function getActiveShard(string $game, string $puuid, Regional|Platform|string|null $platform = null): ActiveShardData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/riot/account/v1/active-shards/by-game/$game/by-puuid/$puuid",
            returns: true,
            platformType: Regional::class,
            returnType: ActiveShardData::class,
            platform: $platform,
        );
    }

    /**
     * @returns AccountRegionData
     */
    public function getActiveRegion(
        string $puuid,
        string $game,
        Regional|Platform|string|null $platform = null,
    ): AccountRegionData {
        return $this->fetch(
            method: 'GET',
            endpoint: "/riot/account/v1/region/by-game/$game/by-puuid/$puuid",
            returns: true,
            platformType: Regional::class,
            returnType: AccountRegionData::class,
            platform: $platform,
        );
    }
}
