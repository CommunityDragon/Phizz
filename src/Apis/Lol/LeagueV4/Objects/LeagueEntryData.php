<?php

namespace Phizz\Apis\Lol\LeagueV4\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $league_id
 * @property-read string $puuid Player's encrypted puuid.
 * @property-read string $queue_type
 * @property-read string $tier
 * @property-read string $rank The player's division within a tier.
 * @property-read int $league_points
 * @property-read int $wins Winning team on Summoners Rift.
 * @property-read int $losses Losing team on Summoners Rift.
 * @property-read bool $hot_streak
 * @property-read bool $veteran
 * @property-read bool $fresh_blood
 * @property-read bool $inactive
 * @property-read string $summoner_id Encrypted summoner ID. This field is deprecated and will be removed. Use `puuid` instead.
 * @property-read MiniSeriesData $miniSeries
 */
class LeagueEntryData extends Data
{
    protected array $objects = [
        'mini_series' => MiniSeriesData::class,
    ];
}
