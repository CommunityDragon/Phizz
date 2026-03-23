<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $reward_strategy
 * @property-read ProgressGroupValueMilestoneValuePropertySelectionStrategyConfigData $selectionStrategyConfig
 * @property-read Collection<int, ProgressGroupValueMilestoneValuePropertyRewardData> $rewards
 */
class ProgressGroupValueMilestoneValuePropertyData extends StaticData
{
    protected array $objects = [
        'selection_strategy_config' => ProgressGroupValueMilestoneValuePropertySelectionStrategyConfigData::class,
    ];

    protected array $collections = [
        'rewards' => ProgressGroupValueMilestoneValuePropertyRewardData::class,
    ];
}
