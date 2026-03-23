<?php

namespace Phizz\Assets\Lol\Loot\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $description
 * @property-read string $description_long
 * @property-read string $image
 * @property-read Collection<int, LootTableDropChanceData> $dropChance
 */
class LootTableData extends StaticData
{
    protected array $collections = [
        'drop_chance' => LootTableDropChanceData::class,
    ];
}
