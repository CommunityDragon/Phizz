<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ObjectivesGroupData> $objectivesGroup
 */
class ObjectiveData extends StaticData
{
    protected array $collections = [
        'objectives_group' => ObjectivesGroupData::class,
    ];
}
