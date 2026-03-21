<?php

namespace Phizz\Apis\Lol\ChampionV3;

use Phizz\Apis\Lol\ChampionV3\Objects\ChampionInfoData;
use Phizz\Cache\Lol\ChampionV3Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChampionV3Api extends Api
{
    /**
     * @returns ChampionInfoData
     */
    public function getChampionInfo(Platform|string|null $platform = null, bool $force = false): ChampionInfoData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/platform/v3/champion-rotations',
            cacheKey: ChampionV3Ttl::getChampionInfo,
            returns: true,
            platformType: Platform::class,
            returnType: ChampionInfoData::class,
            platform: $platform,
            force: $force,
        );
    }
}
