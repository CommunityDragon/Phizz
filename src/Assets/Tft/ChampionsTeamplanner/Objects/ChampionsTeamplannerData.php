<?php

namespace Phizz\Assets\Tft\ChampionsTeamplanner\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, TFTSet16Data> $tftSet16
 * @property-read Collection<int, TFTSet4Act2Data> $tftSet4Act2
 */
class ChampionsTeamplannerData extends StaticData
{
    protected array $collections = [
        'tft_set_16' => TFTSet16Data::class,
        'tft_set_4_act_2' => TFTSet4Act2Data::class,
    ];
}
