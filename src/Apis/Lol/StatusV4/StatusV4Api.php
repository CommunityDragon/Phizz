<?php

namespace Phizz\Apis\Lol\StatusV4;

use Phizz\Apis\Lol\StatusV4\Objects\PlatformDataData;
use Phizz\Cache\Lol\StatusV4Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class StatusV4Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(Platform|string|null $platform = null, bool $force = false): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/status/v4/platform-data',
            cacheKey: StatusV4Ttl::getPlatformData,
            returns: true,
            platformType: Platform::class,
            returnType: PlatformDataData::class,
            platform: $platform,
            force: $force,
        );
    }
}
