<?php

namespace Phizz\CDragon\Objectives\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesLiveData $live
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesPBEData $pbe
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesInternalData $internal
 */
class ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesData extends StaticData
{
    protected array $objects = [
        'live' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesLiveData::class,
        'pbe' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesPBEData::class,
        'internal' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataDatesTFTPassDateRangesInternalData::class,
    ];
}
