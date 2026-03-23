<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $icon_image
 * @property-read Collection<int, ProgressGroupValueMilestoneData> $milestones
 * @property-read ProgressGroupValuePrerequisiteBoonData $prerequisiteBoon
 */
class ProgressGroupValueData extends StaticData
{
    protected array $objects = [
        'prerequisite_boon' => ProgressGroupValuePrerequisiteBoonData::class,
    ];

    protected array $collections = [
        'milestones' => ProgressGroupValueMilestoneData::class,
    ];
}
