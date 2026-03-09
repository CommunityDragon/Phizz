<?php

namespace Phizz\Apis\Lor\StatusV1;

use Phizz\Apis\Lor\StatusV1\Objects\PlatformDataData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class StatusV1Api extends Api
{
    /**
     * @returns PlatformDataData
     */
    public function getPlatformData(Regional|Platform|string|null $platform = null): PlatformDataData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/status/v1/platform-data',
            returns: true,
            platformType: Regional::class,
            returnType: PlatformDataData::class,
            platform: $platform,
        );
    }
}
