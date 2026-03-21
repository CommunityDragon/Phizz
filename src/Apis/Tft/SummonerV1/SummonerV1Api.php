<?php

namespace Phizz\Apis\Tft\SummonerV1;

use Phizz\Apis\Tft\SummonerV1\Objects\SummonerData;
use Phizz\Cache\Tft\SummonerV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class SummonerV1Api extends Api
{
    /**
     * @returns SummonerData
     */
    public function getByPuuid(string $encryptedPuuid, Platform|string|null $platform = null, bool $force = false): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/summoner/v1/summoners/by-puuid/{encryptedPUUID}',
            cacheKey: SummonerV1Ttl::getByPuuid,
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns SummonerData
     */
    public function getByAccessToken(Platform|string|null $platform = null, bool $force = false): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/summoner/v1/summoners/me',
            cacheKey: SummonerV1Ttl::getByAccessToken,
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
            force: $force,
        );
    }
}
