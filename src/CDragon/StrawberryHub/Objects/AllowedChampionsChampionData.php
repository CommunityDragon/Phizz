<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read AllowedChampionsChampionValueData $value
 */
class AllowedChampionsChampionData extends StaticData
{
    protected array $objects = [
        'value' => AllowedChampionsChampionValueData::class,
    ];
}
