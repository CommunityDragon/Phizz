<?php

namespace Phizz\CDragon\Tftsets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read LCTFTModeDataData $lctftModeData
 */
class TftsetData extends StaticData
{
    protected array $objects = [
        'lctft_mode_data' => LCTFTModeDataData::class,
    ];
}
