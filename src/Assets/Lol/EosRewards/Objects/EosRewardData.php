<?php

namespace Phizz\Assets\Lol\EosRewards\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $season_id
 * @property-read Collection<int, RewardData> $rewards
 * @property-read Collection<int, RewardGroupData> $rewardGroups
 */
class EosRewardData extends StaticData
{
    protected array $collections = [
        'rewards' => RewardData::class,
        'reward_groups' => RewardGroupData::class,
    ];
}
