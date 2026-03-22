<?php

namespace Phizz\CDragon\Tftsets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $translated_short_display_name
 * @property-read string $translated_set_header_name
 * @property-read LCTFTModeDataMActiveSetSetTeamPlannerDataTextIconDataData $textIconData
 */
class LCTFTModeDataMActiveSetSetTeamPlannerDataData extends StaticData
{
    protected array $objects = [
        'text_icon_data' => LCTFTModeDataMActiveSetSetTeamPlannerDataTextIconDataData::class,
    ];
}
