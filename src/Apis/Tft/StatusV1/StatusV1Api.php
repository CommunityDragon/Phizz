<?php

namespace Phizz\Apis\Tft\StatusV1;

use Phizz\Apis\Tft\StatusV1\Objects\PlatformDataData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class StatusV1Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(Platform|string|null $platform = null): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/tft/status/v1/platform-data',
            returns: true,
            platformType: Platform::class,
            returnType: PlatformDataData::class,
            platform: $platform,
        );
    }
}
