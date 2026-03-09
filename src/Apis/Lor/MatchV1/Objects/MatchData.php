<?php

namespace Phizz\Apis\Lor\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read MetadataData $metadata
 * @property-read InfoData $info
 */
class MatchData extends Data
{
    protected array $objects = [
        'metadata' => MetadataData::class,
        'info' => InfoData::class,
    ];
}
