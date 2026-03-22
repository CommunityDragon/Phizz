<?php

namespace Phizz\CDragon\Objectives\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $objective_category_type
 * @property-read ObjectivesGroupObjectivesCategoryCategoryTitleData $categoryTitle
 * @property-read ObjectivesGroupObjectivesCategoryObjectivesData $objectives
 * @property-read string $override_background_image
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataData $tFtPassData
 * @property-read string $category_section_image
 * @property-read string|null $id
 * @property-read int|null $start_date
 * @property-read int|null $end_date
 * @property-read string|null $objective_category_filter
 * @property-read ObjectivesGroupObjectivesCategoryEventHubConfigurationData $eventHubConfiguration
 */
class ObjectivesGroupObjectivesCategoryData extends StaticData
{
    protected array $objects = [
        'category_title' => ObjectivesGroupObjectivesCategoryCategoryTitleData::class,
        'objectives' => ObjectivesGroupObjectivesCategoryObjectivesData::class,
        't_ft_pass_data' => ObjectivesGroupObjectivesCategoryTFTPassDataData::class,
        'event_hub_configuration' => ObjectivesGroupObjectivesCategoryEventHubConfigurationData::class,
    ];
}
