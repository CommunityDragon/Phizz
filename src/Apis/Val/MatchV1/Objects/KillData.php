<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $time_since_game_start_millis
 * @property-read int $time_since_round_start_millis
 * @property-read string $killer PUUID
 * @property-read string $victim PUUID
 * @property-read Collection<int, string> $assistants List of PUUIDs
 * @property-read Collection<int, PlayerLocationsData> $playerLocations
 * @property-read LocationData $victimLocation
 * @property-read FinishingDamageData $finishingDamage
 */
class KillData extends Data
{
    protected array $collections = [
        'assistants',
        'player_locations' => PlayerLocationsData::class,
    ];

    protected array $objects = [
        'victim_location' => LocationData::class,
        'finishing_damage' => FinishingDamageData::class,
    ];
}
