<?php

namespace Phizz\CDragon\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read EventRewardTrackTrackConfigData $trackConfig
 */
class EventRewardTrackData extends StaticData
{
    protected array $objects = [
        'track_config' => EventRewardTrackTrackConfigData::class,
    ];
}
