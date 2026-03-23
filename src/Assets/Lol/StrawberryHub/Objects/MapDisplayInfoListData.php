<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read MapDisplayInfoListValueData $value
 */
class MapDisplayInfoListData extends StaticData
{
    protected array $objects = [
        'value' => MapDisplayInfoListValueData::class,
    ];
}
