<?php

namespace Phizz\Assets\Lol\SettingsToPersist\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, FileData> $files
 */
class SettingsToPersistData extends StaticData
{
    protected array $collections = [
        'files' => FileData::class,
    ];
}
