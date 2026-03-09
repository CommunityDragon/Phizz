<?php

namespace Phizz\Apis\Lol\TournamentV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $metadata Optional string that may contain any data in any format, if specified at all. Used to denote any custom information about the game.
 * @property-read int $team_size The team size of the game. Valid values are 1-5.
 * @property-read string $pick_type The pick type of the game.
 *              (Legal values:  BLIND_PICK,  DRAFT_MODE,  ALL_RANDOM,  TOURNAMENT_DRAFT)
 * @property-read string $map_type The map type of the game.
 *              (Legal values:  SUMMONERS_RIFT,  HOWLING_ABYSS)
 * @property-read string $spectator_type The spectator type of the game.
 *              (Legal values:  NONE,  LOBBYONLY,  ALL)
 * @property-read bool $enough_players Checks if allowed participants are enough to make full teams.
 * @property-read Collection<int, string> $allowedParticipants Optional list of encrypted puuids in order to validate the players eligible to join the lobby. NOTE: We currently do not enforce participants at the team level, but rather the aggregate of teamOne and teamTwo. We may add the ability to enforce at the team level in the future.
 */
class TournamentCodeParametersV5Data extends Data
{
    protected array $collections = [
        'allowed_participants',
    ];
}
