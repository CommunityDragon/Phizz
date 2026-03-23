<?php

namespace Phizz\Assets\Tft\Sets\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, LCTFTModeDataMActiveSetData> $mActiveSets
 * @property-read LCTFTModeDataMDefaultSetData $mDefaultSet
 * @property-read LCTFTModeDataMDefaultTeamPlannerSetData $mDefaultTeamPlannerSet
 * @property-read LCTFTModeDataMEventSetData $mEventSet
 * @property-read string $m_default_team_name
 * @property-read string $m_default_team_name_numbered
 */
class LCTFTModeDataData extends StaticData
{
    protected array $objects = [
        'm_default_set' => LCTFTModeDataMDefaultSetData::class,
        'm_default_team_planner_set' => LCTFTModeDataMDefaultTeamPlannerSetData::class,
        'm_event_set' => LCTFTModeDataMEventSetData::class,
    ];

    protected array $collections = [
        'm_active_sets' => LCTFTModeDataMActiveSetData::class,
    ];
}
