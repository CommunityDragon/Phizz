<?php

namespace Phizz\Assets\Lol\CsssheetTeamplanner\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $key
 * @property-read IconValueData $value
 */
class IconData extends StaticData
{
    protected array $objects = [
        'value' => IconValueData::class,
    ];
}
