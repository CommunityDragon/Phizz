<?php

namespace Phizz\Apis\Tft\SummonerV1;

use Phizz\Apis\Tft\SummonerV1\Objects\SummonerData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class SummonerV1Api extends Api
{
    /**
     * @returns SummonerData
     */
    public function getByPuuid(string $encryptedPuuid, Platform|string|null $platform = null): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/tft/summoner/v1/summoners/by-puuid/$encryptedPuuid",
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
        );
    }

    /**
     * @returns SummonerData
     */
    public function getByAccessToken(Platform|string|null $platform = null): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/summoner/v1/summoners/me',
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
        );
    }
}
