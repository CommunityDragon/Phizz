<?php

namespace Phizz\Assets\Tft\CapMissionCollection\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $mission_id
 * @property-read string $title
 * @property-read string $description
 * @property-read SeriesListMissionMissionIconAssetData $missionIconAsset
 * @property-read Collection<int, SeriesListMissionRewardData> $rewards
 * @property-read Collection<int, SeriesListMissionObjectiveData> $objectives
 */
class SeriesListMissionData extends StaticData
{
    protected array $objects = [
        'mission_icon_asset' => SeriesListMissionMissionIconAssetData::class,
    ];

    protected array $collections = [
        'rewards' => SeriesListMissionRewardData::class,
        'objectives' => SeriesListMissionObjectiveData::class,
    ];
}
