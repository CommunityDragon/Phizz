<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $milestone_id
 * @property-read int $points_needed_for_level
 * @property-read bool $is_key_stone
 * @property-read bool $is_bonus
 * @property-read string $name_tra_key_override
 * @property-read string $description_tra_key_override
 * @property-read mixed|null $milestone_asset
 * @property-read bool $is_auto_claim_rewards
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardData> $rewards
 */
class ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataData extends StaticData
{
    protected array $collections = [
        'rewards' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardData::class,
    ];
}
