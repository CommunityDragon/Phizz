<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read int $trigger_value
 * @property-read Collection<int, ProgressGroupValueMilestoneValuePropertyData> $properties
 * @property-read ProgressGroupValueMilestoneValueCounterData $counter
 */
class ProgressGroupValueMilestoneValueData extends StaticData
{
    protected array $objects = [
        'counter' => ProgressGroupValueMilestoneValueCounterData::class,
    ];

    protected array $collections = [
        'properties' => ProgressGroupValueMilestoneValuePropertyData::class,
    ];
}
