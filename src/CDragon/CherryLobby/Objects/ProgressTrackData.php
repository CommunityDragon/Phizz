<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read Collection<int, ProgressTrackCounterDefinitionData> $counterDefinitions
 * @property-read Collection<int, ProgressTrackMilestoneDefinitionData> $milestoneDefinitions
 */
class ProgressTrackData extends StaticData
{
    protected array $collections = [
        'counter_definitions' => ProgressTrackCounterDefinitionData::class,
        'milestone_definitions' => ProgressTrackMilestoneDefinitionData::class,
    ];
}
