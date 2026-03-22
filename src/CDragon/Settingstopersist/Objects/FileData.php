<?php

namespace Phizz\CDragon\Settingstopersist\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read bool $persisted
 * @property-read Collection<int, FileSectionData> $sections
 */
class FileData extends StaticData
{
    protected array $collections = [
        'sections' => FileSectionData::class,
    ];
}
