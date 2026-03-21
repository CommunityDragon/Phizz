<?php

namespace Phizz\Apis\Lol\SpectatorV5;

use Phizz\Apis\Lol\SpectatorV5\Objects\CurrentGameInfoData;
use Phizz\Cache\Lol\SpectatorV5Ttl;
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
        bool $force = false,
    ): CurrentGameInfoData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/spectator/v5/active-games/by-summoner/{encryptedPUUID}',
            cacheKey: SpectatorV5Ttl::getCurrentGameInfoByPuuid,
            returns: true,
            platformType: Platform::class,
            returnType: CurrentGameInfoData::class,
            platform: $platform,
            pathParams: [
                'encryptedPUUID' => $encryptedPuuid,
            ],
            force: $force,
        );
    }
}
