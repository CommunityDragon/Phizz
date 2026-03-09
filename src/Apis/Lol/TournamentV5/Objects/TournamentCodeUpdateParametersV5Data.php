<?php

namespace Phizz\Apis\Lol\TournamentV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $pick_type The pick type
 *              (Legal values:  BLIND_PICK,  DRAFT_MODE,  ALL_RANDOM,  TOURNAMENT_DRAFT)
 * @property-read string $map_type The map type
 *              (Legal values:  SUMMONERS_RIFT,  HOWLING_ABYSS)
 * @property-read string $spectator_type The spectator type
 *              (Legal values:  NONE,  LOBBYONLY,  ALL)
 * @property-read Collection<int, string> $allowedParticipants Optional list of encrypted puuids in order to validate the players eligible to join the lobby. NOTE: We currently do not enforce participants at the team level, but rather the aggregate of teamOne and teamTwo. We may add the ability to enforce at the team level in the future.
 */
class TournamentCodeUpdateParametersV5Data extends Data
{
    protected array $collections = [
        'allowed_participants',
    ];
}
