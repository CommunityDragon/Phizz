<?php

namespace Phizz\Assets\Tft\Sets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $translated_short_display_name
 * @property-read string $translated_set_header_name
 * @property-read LCTFTModeDataMEventSetSetTeamPlannerDataTextIconDataData $textIconData
 */
class LCTFTModeDataMEventSetSetTeamPlannerDataData extends StaticData
{
    protected array $objects = [
        'text_icon_data' => LCTFTModeDataMEventSetSetTeamPlannerDataTextIconDataData::class,
    ];
}
