<?php

namespace Phizz\Apis\Lol\StatusV4;

use Phizz\Apis\Lol\StatusV4\Objects\PlatformDataData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class StatusV4Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(Platform|string|null $platform = null): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/status/v4/platform-data',
            returns: true,
            platformType: Platform::class,
            returnType: PlatformDataData::class,
            platform: $platform,
        );
    }
}
