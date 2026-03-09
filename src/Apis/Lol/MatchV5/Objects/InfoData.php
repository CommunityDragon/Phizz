<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $end_of_game_result Refer to indicate if the game ended in termination.
 * @property-read int $game_creation Unix timestamp for when the game is created on the game server (i.e., the loading screen).
 * @property-read int $game_duration Prior to patch 11.20, this field returns the game length in milliseconds calculated from gameEndTimestamp - gameStartTimestamp. Post patch 11.20, this field returns the max timePlayed of any participant in the game in seconds, which makes the behavior of this field consistent with that of match-v4. The best way to handling the change in this field is to treat the value as milliseconds if the gameEndTimestamp field isn't in the response and to treat the value as seconds if gameEndTimestamp is in the response.
 * @property-read int $game_end_timestamp Unix timestamp for when match ends on the game server. This timestamp can occasionally be significantly longer than when the match "ends". The most reliable way of determining the timestamp for the end of the match would be to add the max time played of any participant to the gameStartTimestamp. This field was added to match-v5 in patch 11.20 on Oct 5th, 2021.
 * @property-read int $game_id
 * @property-read string $game_mode Refer to the Game Constants documentation.
 * @property-read string $game_name
 * @property-read int $game_start_timestamp Unix timestamp for when match starts on the game server.
 * @property-read string $game_type
 * @property-read string $game_version The first two parts can be used to determine the patch a game was played on.
 * @property-read int $map_id Refer to the Game Constants documentation.
 * @property-read string $platform_id Platform where the match was played.
 * @property-read int $queue_id Refer to the Game Constants documentation.
 * @property-read string $tournament_code Tournament code used to generate the match. This field was added to match-v5 in patch 11.13 on June 23rd, 2021.
 * @property-read Collection<int, ParticipantData> $participants
 * @property-read Collection<int, TeamData> $teams
 * @property-read Collection<int, string> $gameModeMutators
 */
class InfoData extends Data
{
    protected array $collections = [
        'participants' => ParticipantData::class,
        'teams' => TeamData::class,
        'game_mode_mutators',
    ];
}
