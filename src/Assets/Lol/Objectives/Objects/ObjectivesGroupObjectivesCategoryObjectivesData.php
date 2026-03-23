<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryObjectivesPooledObjectiveData> $pooledObjectives
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryObjectivesNonPooledObjectiveData> $nonPooledObjectives
 */
class ObjectivesGroupObjectivesCategoryObjectivesData extends StaticData
{
    protected array $collections = [
        'pooled_objectives' => ObjectivesGroupObjectivesCategoryObjectivesPooledObjectiveData::class,
        'non_pooled_objectives' => ObjectivesGroupObjectivesCategoryObjectivesNonPooledObjectiveData::class,
    ];
}
