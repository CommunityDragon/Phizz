<?php

namespace Phizz\Assets\Tft\CapMissionCollection\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read DatesLiveData $live
 * @property-read DatesPbeData $pbe
 * @property-read DatesInternalData $internal
 */
class DatesData extends StaticData
{
    protected array $objects = [
        'live' => DatesLiveData::class,
        'pbe' => DatesPbeData::class,
        'internal' => DatesInternalData::class,
    ];
}
