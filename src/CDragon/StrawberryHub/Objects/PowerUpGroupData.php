<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read PowerUpGroupValueData $value
 */
class PowerUpGroupData extends StaticData
{
    protected array $objects = [
        'value' => PowerUpGroupValueData::class,
    ];
}
