<?php

namespace Phizz\CDragon\Tftchemtechstoredata\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ItemData> $items
 */
class TftchemtechstoredatumData extends StaticData
{
    protected array $collections = [
        'items' => ItemData::class,
    ];
}
