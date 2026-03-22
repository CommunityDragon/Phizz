<?php

namespace Phizz\CDragon\Objectives\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueData $value
 */
class ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneData extends StaticData
{
    protected array $objects = [
        'value' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueData::class,
    ];
}
