<?php

namespace Phizz\Apis\Riftbound\ContentV1;

use Phizz\Apis\Riftbound\ContentV1\Objects\RiftboundContentData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class ContentV1Api extends Api
{
    /**
     * @returns RiftboundContentData
     */
    public function getContent(?string $locale = null, Regional|Platform|string|null $platform = null): RiftboundContentData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riftbound/content/v1/contents',
            returns: true,
            platformType: Regional::class,
            returnType: RiftboundContentData::class,
            platform: $platform,
            query: [
                'locale' => $locale,
            ],
        );
    }
}
