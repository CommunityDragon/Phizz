<?php

namespace Phizz\Apis\Tft\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $character_id This field was introduced in patch 9.22 with data_version 2.
 * @property-read string $chosen If a unit is chosen as part of the Fates set mechanic, the chosen trait will be indicated by this field. Otherwise this field is excluded from the response.
 * @property-read string $name Unit name. This field is often left blank.
 * @property-read int $rarity Unit rarity. This doesn't equate to the unit cost.
 * @property-read int $tier Unit tier.
 * @property-read Collection<int, int> $items A list of the unit's items. Please refer to the Teamfight Tactics documentation for item ids.
 * @property-read Collection<int, string> $itemNames
 */
class UnitData extends Data
{
    protected array $collections = [
        'items',
    ];
}
