<?php

namespace Phizz\Assets\Lol\StatStones\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read int $item_id
 * @property-read string $inventory_type
 * @property-read string $content_id
 * @property-read Collection<int, StatstoneDatumStatstoneData> $statstones
 */
class StatstoneDatumData extends StaticData
{
    protected array $collections = [
        'statstones' => StatstoneDatumStatstoneData::class,
    ];
}
