<?php

namespace Phizz\CDragon\Settingstopersist\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, FileData> $files
 */
class SettingstopersistData extends StaticData
{
    protected array $collections = [
        'files' => FileData::class,
    ];
}
