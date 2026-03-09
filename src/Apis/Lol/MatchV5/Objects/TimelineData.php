<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read MetadataTimeLineData $metadata
 * @property-read InfoTimeLineData $info
 */
class TimelineData extends Data
{
    protected array $objects = [
        'metadata' => MetadataTimeLineData::class,
        'info' => InfoTimeLineData::class,
    ];
}
