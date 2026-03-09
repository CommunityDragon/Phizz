<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $timestamp
 * @property-read int $real_timestamp
 * @property-read string $type
 * @property-read int $item_id
 * @property-read int $participant_id
 * @property-read string $level_up_type
 * @property-read int $skill_slot
 * @property-read int $creator_id
 * @property-read string $ward_type
 * @property-read int $level
 * @property-read int $bounty
 * @property-read int $kill_streak_length
 * @property-read int $killer_id
 * @property-read int $victim_id
 * @property-read string $kill_type
 * @property-read string $lane_type
 * @property-read int $team_id
 * @property-read int $multi_kill_length
 * @property-read int $killer_team_id
 * @property-read string $monster_type
 * @property-read string $monster_sub_type
 * @property-read string $building_type
 * @property-read string $tower_type
 * @property-read int $after_id
 * @property-read int $before_id
 * @property-read int $gold_gain
 * @property-read int $game_id
 * @property-read int $winning_team
 * @property-read string $transform_type
 * @property-read string $name
 * @property-read int $shutdown_bounty
 * @property-read int $actual_start_time
 * @property-read int $feat_type
 * @property-read int $feat_value
 * @property-read Collection<int, int> $assistingParticipantIds
 * @property-read Collection<int, MatchTimelineVictimDamageData> $victimDamageDealt
 * @property-read Collection<int, MatchTimelineVictimDamageData> $victimDamageReceived
 * @property-read Collection<int, MatchTimelineVictimDamageData> $victimTeamfightDamageDealt
 * @property-read Collection<int, MatchTimelineVictimDamageData> $victimTeamfightDamageReceived
 * @property-read PositionData $position
 */
class EventsTimeLineData extends Data
{
    protected array $collections = [
        'assisting_participant_ids',
        'victim_damage_dealt' => MatchTimelineVictimDamageData::class,
        'victim_damage_received' => MatchTimelineVictimDamageData::class,
        'victim_teamfight_damage_dealt' => MatchTimelineVictimDamageData::class,
        'victim_teamfight_damage_received' => MatchTimelineVictimDamageData::class,
    ];

    protected array $objects = [
        'position' => PositionData::class,
    ];
}
