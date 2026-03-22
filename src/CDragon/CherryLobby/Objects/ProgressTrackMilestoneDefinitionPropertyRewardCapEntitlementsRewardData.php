<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $localized_title
 * @property-read string $localized_details
 * @property-read string $reward_type
 * @property-read int $quantity
 * @property-read ProgressTrackMilestoneDefinitionPropertyRewardCapEntitlementsRewardMediaData $media
 * @property-read string $item_id
 * @property-read string $item_inventory_type
 */
class ProgressTrackMilestoneDefinitionPropertyRewardCapEntitlementsRewardData extends StaticData
{
    protected array $objects = [
        'media' => ProgressTrackMilestoneDefinitionPropertyRewardCapEntitlementsRewardMediaData::class,
    ];
}
