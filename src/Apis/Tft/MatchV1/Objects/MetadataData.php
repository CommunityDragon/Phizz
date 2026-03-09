<?php

namespace Phizz\Apis\Tft\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $data_version Match data version.
 * @property-read string $match_id Match id.
 * @property-read Collection<int, string> $participants A list of participant PUUIDs.
 */
class MetadataData extends Data
{
    protected array $collections = [
        'participants',
    ];
}
