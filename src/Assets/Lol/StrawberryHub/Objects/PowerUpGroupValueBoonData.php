<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read PowerUpGroupValueBoonValueData $value
 */
class PowerUpGroupValueBoonData extends StaticData
{
    protected array $objects = [
        'value' => PowerUpGroupValueBoonValueData::class,
    ];
}
