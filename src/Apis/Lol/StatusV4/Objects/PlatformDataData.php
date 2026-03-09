<?php

namespace Phizz\Apis\Lol\StatusV4\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read Collection<int, string> $locales
 * @property-read Collection<int, StatusData> $maintenances
 * @property-read Collection<int, StatusData> $incidents
 */
class PlatformDataData extends Data
{
    protected array $collections = [
        'locales',
        'maintenances' => StatusData::class,
        'incidents' => StatusData::class,
    ];
}
