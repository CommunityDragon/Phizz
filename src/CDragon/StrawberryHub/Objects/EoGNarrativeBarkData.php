<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read EoGNarrativeBarkValueData $value
 */
class EoGNarrativeBarkData extends StaticData
{
    protected array $objects = [
        'value' => EoGNarrativeBarkValueData::class,
    ];
}
