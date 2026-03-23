<?php

namespace Phizz\Assets\Lol\Perkstyles\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $schema_version
 * @property-read Collection<int, StyleData> $styles
 */
class PerkstyleData extends StaticData
{
    protected array $collections = [
        'styles' => StyleData::class,
    ];
}
