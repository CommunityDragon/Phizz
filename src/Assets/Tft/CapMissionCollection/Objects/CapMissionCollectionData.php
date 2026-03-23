<?php

namespace Phizz\Assets\Tft\CapMissionCollection\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $mission_collection_id
 * @property-read DatesData $dates
 * @property-read Collection<int, SeriesListData> $seriesList
 */
class CapMissionCollectionData extends StaticData
{
    protected array $objects = [
        'dates' => DatesData::class,
    ];

    protected array $collections = [
        'series_list' => SeriesListData::class,
    ];
}
