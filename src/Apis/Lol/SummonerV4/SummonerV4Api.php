<?php

namespace Phizz\Apis\Lol\SummonerV4;

use Phizz\Apis\Lol\SummonerV4\Objects\SummonerData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class SummonerV4Api extends Api
{
    /**
     * @returns SummonerData
     */
    public function getByPuuid(string $encryptedPuuid, Platform|string|null $platform = null): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/summoner/v4/summoners/by-puuid/$encryptedPuuid",
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
            endpoint: '/lol/summoner/v4/summoners/me',
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
        );
    }
}
