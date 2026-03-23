<?php

namespace Phizz\Assets\Tft\Sets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $set_name
 * @property-read string $set_core_name
 * @property-read string $set_display_name
 * @property-read string $set_augment_name
 * @property-read string $set_augment_container
 * @property-read string $set_portal_system_name
 * @property-read LCTFTModeDataMActiveSetSetTeamPlannerDataData $setTeamPlannerData
 */
class LCTFTModeDataMActiveSetData extends StaticData
{
    protected array $objects = [
        'set_team_planner_data' => LCTFTModeDataMActiveSetSetTeamPlannerDataData::class,
    ];
}
