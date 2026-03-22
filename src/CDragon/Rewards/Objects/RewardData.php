<?php

namespace Phizz\CDragon\Rewards\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read CelebrationAssetsData $celebrationAssets
 * @property-read array $rewards
 */
class RewardData extends StaticData
{
    protected array $objects = [
        'celebration_assets' => CelebrationAssetsData::class,
    ];
}
