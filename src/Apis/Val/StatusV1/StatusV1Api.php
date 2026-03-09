<?php

namespace Phizz\Apis\Val\StatusV1;

use Phizz\Apis\Val\StatusV1\Objects\PlatformDataData;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class StatusV1Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(ValPlatform|string|null $platform = null): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/status/v1/platform-data',
            returns: true,
            platformType: ValPlatform::class,
            returnType: PlatformDataData::class,
            platform: $platform,
        );
    }
}
