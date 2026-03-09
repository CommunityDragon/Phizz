<?php

namespace Phizz\Apis\Tft\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $gold_left Gold left after participant was eliminated.
 * @property-read int $last_round The round the participant was eliminated in. Note: If the player was eliminated in stage 2-1 their last_round would be 5.
 * @property-read int $level Participant Little Legend level. Note: This is not the number of active units.
 * @property-read int $placement Participant placement upon elimination.
 * @property-read int $players_eliminated Number of players the participant eliminated.
 * @property-read string $puuid
 * @property-read string $riot_id_game_name
 * @property-read string $riot_id_tagline
 * @property-read float $time_eliminated The number of seconds before the participant was eliminated.
 * @property-read int $total_damage_to_players Damage the participant dealt to other players.
 * @property-read bool $win
 * @property-read int $partner_group_id
 * @property-read array $skill_tree
 * @property-read int $pve_score
 * @property-read bool $pve_wonrun
 * @property-read Collection<int, TraitData> $traits A complete list of traits for the participant's active units.
 * @property-read Collection<int, UnitData> $units A list of active units for the participant.
 * @property-read Collection<int, string> $augments
 * @property-read CompanionData $companion
 * @property-read ParticipantMissionsData $missions
 */
class ParticipantData extends Data
{
    protected array $collections = [
        'traits' => TraitData::class,
        'units' => UnitData::class,
        'augments',
    ];

    protected array $objects = [
        'companion' => CompanionData::class,
        'missions' => ParticipantMissionsData::class,
    ];
}
