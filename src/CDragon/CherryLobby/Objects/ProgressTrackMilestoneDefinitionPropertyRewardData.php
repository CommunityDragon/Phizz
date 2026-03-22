<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read ProgressTrackMilestoneDefinitionPropertyRewardCapEntitlementsRewardData $capEntitlementsReward
 */
class ProgressTrackMilestoneDefinitionPropertyRewardData extends StaticData
{
    protected array $objects = [
        'cap_entitlements_reward' => ProgressTrackMilestoneDefinitionPropertyRewardCapEntitlementsRewardData::class,
    ];
}
