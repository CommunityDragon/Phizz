<?php

namespace Phizz\Apis\Lol\SpectatorV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $game_id The ID of the game
 * @property-read string $game_type The game type
 * @property-read int $game_start_time The game start time represented in epoch milliseconds
 * @property-read int $map_id The ID of the map
 * @property-read int $game_length The amount of time in seconds that has passed since the game started
 * @property-read string $platform_id The ID of the platform on which the game is being played
 * @property-read string $game_mode The game mode
 * @property-read int $game_queue_config_id The queue type (queue types are documented on the Game Constants page)
 * @property-read Collection<int, BannedChampionData> $bannedChampions Banned champion information
 * @property-read Collection<int, CurrentGameParticipantData> $participants The participant information
 * @property-read ObserverData $observers
 */
class CurrentGameInfoData extends Data
{
    protected array $collections = [
        'banned_champions' => BannedChampionData::class,
        'participants' => CurrentGameParticipantData::class,
    ];

    protected array $objects = [
        'observers' => ObserverData::class,
    ];
}
