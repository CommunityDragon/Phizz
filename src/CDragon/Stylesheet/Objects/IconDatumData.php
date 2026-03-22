<?php

namespace Phizz\CDragon\Stylesheet\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $key
 * @property-read IconDatumValueData $value
 */
class IconDatumData extends StaticData
{
    protected array $objects = [
        'value' => IconDatumValueData::class,
    ];
}
