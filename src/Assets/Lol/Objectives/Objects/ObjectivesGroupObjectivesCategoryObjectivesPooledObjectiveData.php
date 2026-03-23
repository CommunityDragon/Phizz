<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryObjectivesPooledObjectiveObjectivesTitleData> $objectivesTitle
 * @property-read string $id
 * @property-read string $objectives_type
 * @property-read array $tag
 * @property-read string $localized_tag
 * @property-read int $start_date
 * @property-read int $end_date
 * @property-read int $priority
 * @property-read string $background_image
 * @property-read bool $is_enabled
 * @property-read int $max_refresh
 * @property-read int $refresh_interval
 */
class ObjectivesGroupObjectivesCategoryObjectivesPooledObjectiveData extends StaticData
{
    protected array $collections = [
        'objectives_title' => ObjectivesGroupObjectivesCategoryObjectivesPooledObjectiveObjectivesTitleData::class,
    ];
}
