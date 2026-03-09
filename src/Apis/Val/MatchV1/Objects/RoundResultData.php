<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $round_num
 * @property-read string $round_result
 * @property-read string $round_ceremony
 * @property-read string $winning_team
 * @property-read string $winning_team_role
 * @property-read string $bomb_planter PUUID of player
 * @property-read string $bomb_defuser PUUID of player
 * @property-read int $plant_round_time
 * @property-read string $plant_site
 * @property-read int $defuse_round_time
 * @property-read string $round_result_code
 * @property-read Collection<int, PlayerLocationsData> $plantPlayerLocations
 * @property-read Collection<int, PlayerLocationsData> $defusePlayerLocations
 * @property-read Collection<int, PlayerRoundStatsData> $playerStats
 * @property-read LocationData $plantLocation
 * @property-read LocationData $defuseLocation
 */
class RoundResultData extends Data
{
    protected array $collections = [
        'plant_player_locations' => PlayerLocationsData::class,
        'defuse_player_locations' => PlayerLocationsData::class,
        'player_stats' => PlayerRoundStatsData::class,
    ];

    protected array $objects = [
        'plant_location' => LocationData::class,
        'defuse_location' => LocationData::class,
    ];
}
