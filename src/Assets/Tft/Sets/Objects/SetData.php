<?php

namespace Phizz\Assets\Tft\Sets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read LCTFTModeDataData $lctftModeData
 */
class SetData extends StaticData
{
    protected array $objects = [
        'lctft_mode_data' => LCTFTModeDataData::class,
    ];
}
