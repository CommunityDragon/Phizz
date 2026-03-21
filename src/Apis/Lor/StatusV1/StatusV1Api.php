<?php

namespace Phizz\Apis\Lor\StatusV1;

use Phizz\Apis\Lor\StatusV1\Objects\PlatformDataData;
use Phizz\Cache\Lor\StatusV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class StatusV1Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(Regional|Platform|string|null $platform = null, bool $force = false): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/status/v1/platform-data',
            cacheKey: StatusV1Ttl::getPlatformData,
            returns: true,
            platformType: Regional::class,
            returnType: PlatformDataData::class,
            platform: $platform,
            force: $force,
        );
    }
}
