<?php

namespace Phizz\CDragon\Stylesheet\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $icon_texture
 * @property-read Collection<int, IconDatumData> $iconData
 */
class StylesheetData extends StaticData
{
    protected array $collections = [
        'icon_data' => IconDatumData::class,
    ];
}
