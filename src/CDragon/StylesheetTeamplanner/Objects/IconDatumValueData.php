<?php

namespace Phizz\CDragon\StylesheetTeamplanner\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read IconDatumValueXyData $xy
 * @property-read IconDatumValueWhData $wh
 * @property-read float $y_adjustment
 */
class IconDatumValueData extends StaticData
{
    protected array $objects = [
        'xy' => IconDatumValueXyData::class,
        'wh' => IconDatumValueWhData::class,
    ];
}
