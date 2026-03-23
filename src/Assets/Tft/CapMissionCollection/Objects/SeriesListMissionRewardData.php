<?php

namespace Phizz\Assets\Tft\CapMissionCollection\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $item_id
 * @property-read string $reward_name
 * @property-read int $quantity
 * @property-read SeriesListMissionRewardRewardAssetData $rewardAsset
 */
class SeriesListMissionRewardData extends StaticData
{
    protected array $objects = [
        'reward_asset' => SeriesListMissionRewardRewardAssetData::class,
    ];
}
