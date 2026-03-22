<?php

namespace Phizz\CDragon\Leaderboardconfiguration\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read array $groupings
 * @property-read int $page_size
 * @property-read int $refresh_time_ms
 * @property-read string $season
 * @property-read Collection<int, PastSeasonData> $pastSeasons
 */
class LeaderboardconfigurationData extends StaticData
{
    protected array $collections = [
        'past_seasons' => PastSeasonData::class,
    ];
}
