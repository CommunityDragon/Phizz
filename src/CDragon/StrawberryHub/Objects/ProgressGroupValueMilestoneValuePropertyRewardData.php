<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $title
 * @property-read string $details
 * @property-read ProgressGroupValueMilestoneValuePropertyRewardMediaData $media
 * @property-read string $item_id
 * @property-read ProgressGroupValueMilestoneValuePropertyRewardItemTypeData $itemType
 */
class ProgressGroupValueMilestoneValuePropertyRewardData extends StaticData
{
    protected array $objects = [
        'media' => ProgressGroupValueMilestoneValuePropertyRewardMediaData::class,
        'item_type' => ProgressGroupValueMilestoneValuePropertyRewardItemTypeData::class,
    ];
}
