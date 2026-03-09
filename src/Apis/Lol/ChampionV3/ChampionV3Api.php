<?php

namespace Phizz\Apis\Lol\ChampionV3;

use Phizz\Apis\Lol\ChampionV3\Objects\ChampionInfoData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ChampionV3Api extends Api
{
    /**
     * @returns ChampionInfoData
     */
    public function getChampionInfo(Platform|string|null $platform = null): ChampionInfoData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/platform/v3/champion-rotations',
            returns: true,
            platformType: Platform::class,
            returnType: ChampionInfoData::class,
            platform: $platform,
        );
    }
}
