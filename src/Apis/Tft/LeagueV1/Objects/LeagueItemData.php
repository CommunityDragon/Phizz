<?php

namespace Phizz\Apis\Tft\LeagueV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read bool $fresh_blood
 * @property-read int $wins First placement.
 * @property-read bool $inactive
 * @property-read bool $veteran
 * @property-read bool $hot_streak
 * @property-read string $rank
 * @property-read int $league_points
 * @property-read int $losses Second through eighth placement.
 * @property-read string $puuid Player's encrypted puuid.
 * @property-read MiniSeriesData $miniSeries
 */
class LeagueItemData extends Data
{
    protected array $objects = [
        'mini_series' => MiniSeriesData::class,
    ];
}
