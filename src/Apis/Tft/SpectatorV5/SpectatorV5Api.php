<?php

namespace Phizz\Apis\Tft\SpectatorV5;

use Phizz\Apis\Tft\SpectatorV5\Objects\CurrentGameInfoData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class SpectatorV5Api extends Api
{
    /**
     * @returns CurrentGameInfoData
     */
    public function getCurrentGameInfoByPuuid(
        string $encryptedPuuid,
        Platform|string|null $platform = null,
    ): CurrentGameInfoData {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/spectator/tft/v5/active-games/by-puuid/$encryptedPuuid",
            returns: true,
            platformType: Platform::class,
            returnType: CurrentGameInfoData::class,
            platform: $platform,
        );
    }
}
