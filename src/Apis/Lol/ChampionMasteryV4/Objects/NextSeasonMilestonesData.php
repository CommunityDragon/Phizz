<?php

namespace Phizz\Apis\Lol\ChampionMasteryV4\Objects;

use Phizz\Support\Data;

/**
 * @property-read array $require_grade_counts
 * @property-read int $reward_marks Reward marks.
 * @property-read bool $bonus Bonus.
 * @property-read int $total_games_requires
 * @property-read RewardConfigData $rewardConfig This object contains required reward config information.
 */
class NextSeasonMilestonesData extends Data
{
    protected array $objects = [
        'reward_config' => RewardConfigData::class,
    ];
}
