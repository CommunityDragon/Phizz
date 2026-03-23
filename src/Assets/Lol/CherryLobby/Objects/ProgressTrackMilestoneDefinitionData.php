<?php

namespace Phizz\Assets\Lol\CherryLobby\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read int $trigger_value
 * @property-read Collection<int, ProgressTrackMilestoneDefinitionPropertyData> $properties
 * @property-read ProgressTrackMilestoneDefinitionCounterData $counter
 */
class ProgressTrackMilestoneDefinitionData extends StaticData
{
    protected array $objects = [
        'counter' => ProgressTrackMilestoneDefinitionCounterData::class,
    ];

    protected array $collections = [
        'properties' => ProgressTrackMilestoneDefinitionPropertyData::class,
    ];
}
