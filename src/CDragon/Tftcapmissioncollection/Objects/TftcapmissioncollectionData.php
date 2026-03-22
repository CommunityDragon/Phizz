<?php

namespace Phizz\CDragon\Tftcapmissioncollection\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $mission_collection_id
 * @property-read DatesData $dates
 * @property-read Collection<int, SeriesListData> $seriesList
 */
class TftcapmissioncollectionData extends StaticData
{
    protected array $objects = [
        'dates' => DatesData::class,
    ];

    protected array $collections = [
        'series_list' => SeriesListData::class,
    ];
}
