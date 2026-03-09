<?php

namespace Phizz\Apis\Lol\TournamentV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $start_time
 * @property-read string $short_code Tournament Code
 * @property-read string $meta_data Metadata for the TournamentCode
 * @property-read int $game_id
 * @property-read string $game_name
 * @property-read string $game_type
 * @property-read int $game_map Game Map ID
 * @property-read string $game_mode
 * @property-read string $region Region of the game
 * @property-read Collection<int, TournamentTeamV5Data> $winningTeam
 * @property-read Collection<int, TournamentTeamV5Data> $losingTeam
 */
class TournamentGamesV5Data extends Data
{
    protected array $collections = [
        'winning_team' => TournamentTeamV5Data::class,
        'losing_team' => TournamentTeamV5Data::class,
    ];
}
