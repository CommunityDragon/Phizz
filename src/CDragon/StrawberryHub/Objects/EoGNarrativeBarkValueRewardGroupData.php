<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $reward_strategy
 * @property-read EoGNarrativeBarkValueRewardGroupSelectionStrategyConfigData $selectionStrategyConfig
 * @property-read Collection<int, EoGNarrativeBarkValueRewardGroupRewardData> $rewards
 */
class EoGNarrativeBarkValueRewardGroupData extends StaticData
{
    protected array $objects = [
        'selection_strategy_config' => EoGNarrativeBarkValueRewardGroupSelectionStrategyConfigData::class,
    ];

    protected array $collections = [
        'rewards' => EoGNarrativeBarkValueRewardGroupRewardData::class,
    ];
}
