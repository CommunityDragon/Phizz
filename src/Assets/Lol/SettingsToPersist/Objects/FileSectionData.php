<?php

namespace Phizz\Assets\Lol\SettingsToPersist\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read bool $persisted
 * @property-read Collection<int, FileSectionSettingData> $settings
 */
class FileSectionData extends StaticData
{
    protected array $collections = [
        'settings' => FileSectionSettingData::class,
    ];
}
