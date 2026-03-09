<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $current_time
 * @property-read Collection<int, string> $matchIds A list of recent match ids.
 */
class RecentMatchesData extends Data
{
    protected array $collections = [
        'match_ids',
    ];
}
