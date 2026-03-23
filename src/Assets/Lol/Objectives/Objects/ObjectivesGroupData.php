<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $game_type
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryData> $objectivesCategory
 */
class ObjectivesGroupData extends StaticData
{
    protected array $collections = [
        'objectives_category' => ObjectivesGroupObjectivesCategoryData::class,
    ];
}
