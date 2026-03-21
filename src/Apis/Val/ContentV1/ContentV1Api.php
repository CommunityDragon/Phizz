<?php

namespace Phizz\Apis\Val\ContentV1;

use Phizz\Apis\Val\ContentV1\Objects\ContentData;
use Phizz\Cache\Val\ContentV1Ttl;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class ContentV1Api extends Api
{
    /**
     * @returns ContentData
     */
    public function getContent(
        ?string $locale = null,
        ValPlatform|string|null $platform = null,
        bool $force = false,
    ): ContentData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/content/v1/contents',
            cacheKey: ContentV1Ttl::getContent,
            returns: true,
            platformType: ValPlatform::class,
            returnType: ContentData::class,
            platform: $platform,
            query: [
                'locale' => $locale,
            ],
            force: $force,
        );
    }
}
