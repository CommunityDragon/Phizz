<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $reward_strategy
 * @property-read ProgressTrackMilestoneDefinitionPropertySelectionStrategyConfigData $selectionStrategyConfig
 * @property-read Collection<int, ProgressTrackMilestoneDefinitionPropertyRewardData> $rewards
 */
class ProgressTrackMilestoneDefinitionPropertyData extends StaticData
{
    protected array $objects = [
        'selection_strategy_config' => ProgressTrackMilestoneDefinitionPropertySelectionStrategyConfigData::class,
    ];

    protected array $collections = [
        'rewards' => ProgressTrackMilestoneDefinitionPropertyRewardData::class,
    ];
}
