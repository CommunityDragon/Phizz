<?php

namespace Phizz\Apis\Lol\LeagueExpV4\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $league_id
 * @property-read string $summoner_id Player's summonerId (Encrypted)
 * @property-read string $puuid Player's encrypted puuid.
 * @property-read string $queue_type
 * @property-read string $tier
 * @property-read string $rank The player's division within a tier.
 * @property-read int $league_points
 * @property-read int $wins Winning team on Summoners Rift. First placement in Teamfight Tactics.
 * @property-read int $losses Losing team on Summoners Rift. Second through eighth placement in Teamfight Tactics.
 * @property-read bool $hot_streak
 * @property-read bool $veteran
 * @property-read bool $fresh_blood
 * @property-read bool $inactive
 * @property-read MiniSeriesData $miniSeries
 */
class LeagueEntryData extends Data
{
    protected array $objects = [
        'mini_series' => MiniSeriesData::class,
    ];
}
