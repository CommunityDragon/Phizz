<?php

namespace Phizz\Assets\Lol\CsssheetTeamplanner\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, IconData> $icons
 */
class CsssheetTeamplannerData extends StaticData
{
    protected array $collections = [
        'icons' => IconData::class,
    ];
}
