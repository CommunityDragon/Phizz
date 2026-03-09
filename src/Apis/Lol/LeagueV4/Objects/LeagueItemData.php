<?php

namespace Phizz\Apis\Lol\LeagueV4\Objects;

use Phizz\Support\Data;

/**
 * @property-read bool $fresh_blood
 * @property-read int $wins Winning team on Summoners Rift.
 * @property-read bool $inactive
 * @property-read bool $veteran
 * @property-read bool $hot_streak
 * @property-read string $rank
 * @property-read int $league_points
 * @property-read int $losses Losing team on Summoners Rift.
 * @property-read string $puuid Player's encrypted puuid.
 * @property-read string $summoner_id Encrypted summoner ID. This field is deprecated and will be removed. Use `puuid` instead.
 * @property-read MiniSeriesData $miniSeries
 */
class LeagueItemData extends Data
{
    protected array $objects = [
        'mini_series' => MiniSeriesData::class,
    ];
}
