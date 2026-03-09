<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

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
