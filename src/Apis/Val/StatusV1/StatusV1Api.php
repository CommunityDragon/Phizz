<?php

namespace Phizz\Apis\Val\StatusV1;

use Phizz\Apis\Val\StatusV1\Objects\PlatformDataData;
use Phizz\Cache\Val\StatusV1Ttl;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class StatusV1Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(ValPlatform|string|null $platform = null, bool $force = false): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/status/v1/platform-data',
            cacheKey: StatusV1Ttl::getPlatformData,
            returns: true,
            platformType: ValPlatform::class,
            returnType: PlatformDataData::class,
            platform: $platform,
            force: $force,
        );
    }
}
