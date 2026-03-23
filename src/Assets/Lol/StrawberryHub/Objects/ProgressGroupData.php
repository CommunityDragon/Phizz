<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read ProgressGroupValueData $value
 */
class ProgressGroupData extends StaticData
{
    protected array $objects = [
        'value' => ProgressGroupValueData::class,
    ];
}
