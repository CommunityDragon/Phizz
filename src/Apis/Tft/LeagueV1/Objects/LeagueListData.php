<?php

namespace Phizz\Apis\Tft\LeagueV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $league_id
 * @property-read string $tier
 * @property-read string $name
 * @property-read string $queue
 * @property-read Collection<int, LeagueItemData> $entries
 */
class LeagueListData extends Data
{
    protected array $collections = [
        'entries' => LeagueItemData::class,
    ];
}
