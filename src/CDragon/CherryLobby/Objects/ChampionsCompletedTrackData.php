<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read Collection<int, ChampionsCompletedTrackCounterDefinitionData> $counterDefinitions
 * @property-read array $milestone_definitions
 */
class ChampionsCompletedTrackData extends StaticData
{
    protected array $collections = [
        'counter_definitions' => ChampionsCompletedTrackCounterDefinitionData::class,
    ];
}
