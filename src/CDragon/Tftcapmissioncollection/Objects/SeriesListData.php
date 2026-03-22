<?php

namespace Phizz\CDragon\Tftcapmissioncollection\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $series_id
 * @property-read string $series_title
 * @property-read SeriesListSeriesIconAssetData $seriesIconAsset
 * @property-read string $series_background_image_url
 * @property-read Collection<int, SeriesListMissionData> $missions
 */
class SeriesListData extends StaticData
{
    protected array $objects = [
        'series_icon_asset' => SeriesListSeriesIconAssetData::class,
    ];

    protected array $collections = [
        'missions' => SeriesListMissionData::class,
    ];
}
