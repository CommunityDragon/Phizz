<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $bark
 * @property-read string $bark_image
 * @property-read MapDisplayInfoListValueMapData $map
 * @property-read mixed|null $completed_map_boon
 */
class MapDisplayInfoListValueData extends StaticData
{
    protected array $objects = [
        'map' => MapDisplayInfoListValueMapData::class,
    ];
}
