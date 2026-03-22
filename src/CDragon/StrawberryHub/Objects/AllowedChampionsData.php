<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, AllowedChampionsChampionData> $champions
 */
class AllowedChampionsData extends StaticData
{
    protected array $collections = [
        'champions' => AllowedChampionsChampionData::class,
    ];
}
