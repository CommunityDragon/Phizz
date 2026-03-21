<?php

namespace Phizz\Apis\Lol\SummonerV4;

use Phizz\Apis\Lol\SummonerV4\Objects\SummonerData;
use Phizz\Cache\Lol\SummonerV4Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class SummonerV4Api extends Api
{
    /**
     * @returns SummonerData
     */
    public function getByPuuid(string $encryptedPuuid, Platform|string|null $platform = null, bool $force = false): SummonerData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/summoner/v4/summoners/by-puuid/{encryptedPUUID}',
            cacheKey: SummonerV4Ttl::getByPuuid,
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
            endpoint: '/lol/summoner/v4/summoners/me',
            cacheKey: SummonerV4Ttl::getByAccessToken,
            returns: true,
            platformType: Platform::class,
            returnType: SummonerData::class,
            platform: $platform,
            force: $force,
        );
    }
}
