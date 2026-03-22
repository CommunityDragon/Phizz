<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read AllowedChampionsData $allowedChampions
 * @property-read Collection<int, MapDisplayInfoListData> $mapDisplayInfoList
 * @property-read Collection<int, ProgressGroupData> $progressGroups
 * @property-read Collection<int, PowerUpGroupData> $powerUpGroups
 * @property-read Collection<int, EoGNarrativeBarkData> $eoGnarrativeBarks
 */
class StrawberryHubData extends StaticData
{
    protected array $objects = [
        'allowed_champions' => AllowedChampionsData::class,
    ];

    protected array $collections = [
        'map_display_info_list' => MapDisplayInfoListData::class,
        'progress_groups' => ProgressGroupData::class,
        'power_up_groups' => PowerUpGroupData::class,
        'eo_gnarrative_barks' => EoGNarrativeBarkData::class,
    ];
}
