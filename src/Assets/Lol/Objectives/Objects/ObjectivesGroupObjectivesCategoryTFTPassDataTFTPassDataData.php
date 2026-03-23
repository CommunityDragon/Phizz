<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $type
 * @property-read string $counter_id
 * @property-read string $product_id
 * @property-read string $title_tra_key
 * @property-read string $premium_title_tra_key
 * @property-read string $store_description_tra_key
 * @property-read string $store_image
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesData $dates
 * @property-read string $asset_list_id
 * @property-read bool $has_level_purchasing
 * @property-read int $level_purchase_price
 * @property-read string $level_purchase_store_id
 * @property-read string $premium_entitlement_id
 * @property-read string $lcu_store_purchase_id
 * @property-read string $tft_mobile_store_purchase_id
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneData> $milestones
 * @property-read string $spreadsheet_id
 */
class ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataData extends StaticData
{
    protected array $objects = [
        'dates' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesData::class,
    ];

    protected array $collections = [
        'milestones' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneData::class,
    ];
}
