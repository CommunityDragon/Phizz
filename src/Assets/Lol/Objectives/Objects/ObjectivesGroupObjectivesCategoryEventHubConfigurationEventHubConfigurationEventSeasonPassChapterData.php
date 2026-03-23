<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassChapterValueData $value
 */
class ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassChapterData extends StaticData
{
    protected array $objects = [
        'value' => ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassChapterValueData::class,
    ];
}
