<?php

namespace Phizz\Apis\Val\ContentV1;

use Phizz\Apis\Val\ContentV1\Objects\ContentData;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Api;

class ContentV1Api extends Api
{
    /**
     * @returns ContentData
     */
    public function getContent(?string $locale = null, ValPlatform|string|null $platform = null): ContentData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/val/content/v1/contents',
            returns: true,
            platformType: ValPlatform::class,
            returnType: ContentData::class,
            platform: $platform,
            query: [
                'locale' => $locale,
            ],
        );
    }
}
