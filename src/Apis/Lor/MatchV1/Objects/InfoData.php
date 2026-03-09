<?php

namespace Phizz\Apis\Lor\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $game_mode (Legal values:  Constructed,  Expeditions,  Tutorial)
 * @property-read string $game_type (Legal values:  Ranked,  Normal,  AI,  Tutorial,  VanillaTrial,  Singleton,  StandardGauntlet)
 * @property-read string $game_start_time_utc
 * @property-read string $game_version
 * @property-read string $game_format (Legal values:  standard,  eternal)
 * @property-read int $total_turn_count Total turns taken by both players.
 * @property-read Collection<int, PlayerData> $players
 */
class InfoData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
    ];
}
