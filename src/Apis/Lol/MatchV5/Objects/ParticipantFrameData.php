<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $current_gold
 * @property-read int $gold_per_second
 * @property-read int $jungle_minions_killed
 * @property-read int $level
 * @property-read int $minions_killed
 * @property-read int $participant_id
 * @property-read int $time_enemy_spent_controlled
 * @property-read int $total_gold
 * @property-read int $xp
 * @property-read ChampionStatsData $championStats
 * @property-read DamageStatsData $damageStats
 * @property-read PositionData $position
 */
class ParticipantFrameData extends Data
{
    protected array $objects = [
        'champion_stats' => ChampionStatsData::class,
        'damage_stats' => DamageStatsData::class,
        'position' => PositionData::class,
    ];
}
