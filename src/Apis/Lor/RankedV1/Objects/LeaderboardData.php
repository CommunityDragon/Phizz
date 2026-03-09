<?php

namespace Phizz\Apis\Lor\RankedV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read Collection<int, PlayerData> $players A list of players in Master tier.
 */
class LeaderboardData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
    ];
}
