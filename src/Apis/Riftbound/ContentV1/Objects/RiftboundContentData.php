<?php

namespace Phizz\Apis\Riftbound\ContentV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $game Game Name
 * @property-read string $version Content version
 * @property-read string $last_updated ISO Timestamp of content last update
 * @property-read Collection<int, SetData> $sets
 */
class RiftboundContentData extends Data
{
    protected array $collections = [
        'sets' => SetData::class,
    ];
}
