<?php

namespace Phizz\Apis\Lol\TournamentStubV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $code The tournament code.
 * @property-read string $lobby_name The lobby name for the tournament code game.
 * @property-read string $meta_data The metadata for tournament code.
 * @property-read string $password The password for the tournament code game.
 * @property-read int $team_size The team size for the tournament code game.
 * @property-read int $provider_id The provider's ID.
 * @property-read string $pick_type The pick mode for tournament code game.
 * @property-read int $tournament_id The tournament's ID.
 * @property-read int $id The tournament code's ID.
 * @property-read string $region The tournament code's region.
 *              (Legal values:  BR,  EUNE,  EUW,  JP,  LAN,  LAS,  NA,  OCE,  PBE,  RU,  TR,  KR)
 * @property-read string $map The game map for the tournament code game
 * @property-read Collection<int, string> $participants The puuids of the participants (Encrypted)
 */
class TournamentCodeV5Data extends Data
{
    protected array $collections = [
        'participants',
    ];
}
