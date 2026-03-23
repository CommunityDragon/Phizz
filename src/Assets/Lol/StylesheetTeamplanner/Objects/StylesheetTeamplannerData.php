<?php

namespace Phizz\Assets\Lol\StylesheetTeamplanner\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $icon_texture
 * @property-read Collection<int, IconDatumData> $iconData
 */
class StylesheetTeamplannerData extends StaticData
{
    protected array $collections = [
        'icon_data' => IconDatumData::class,
    ];
}
