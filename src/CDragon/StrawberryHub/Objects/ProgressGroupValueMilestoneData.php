<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read ProgressGroupValueMilestoneValueData $value
 */
class ProgressGroupValueMilestoneData extends StaticData
{
    protected array $objects = [
        'value' => ProgressGroupValueMilestoneValueData::class,
    ];
}
