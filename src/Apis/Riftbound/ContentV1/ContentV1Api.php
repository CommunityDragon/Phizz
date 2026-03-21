<?php

namespace Phizz\Apis\Riftbound\ContentV1;

use Phizz\Apis\Riftbound\ContentV1\Objects\RiftboundContentData;
use Phizz\Cache\Riftbound\ContentV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class ContentV1Api extends Api
{
    /**
     * @returns RiftboundContentData
     */
    public function getContent(
        ?string $locale = null,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): RiftboundContentData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/riftbound/content/v1/contents',
            cacheKey: ContentV1Ttl::getContent,
            returns: true,
            platformType: Regional::class,
            returnType: RiftboundContentData::class,
            platform: $platform,
            query: [
                'locale' => $locale,
            ],
            force: $force,
        );
    }
}
