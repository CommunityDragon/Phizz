<?php

namespace Phizz\Assets\Tft\ChemtechStoreData\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ItemData> $items
 */
class ChemtechStoreDatumData extends StaticData
{
    protected array $collections = [
        'items' => ItemData::class,
    ];
}
