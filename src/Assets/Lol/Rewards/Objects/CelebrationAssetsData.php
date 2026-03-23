<?php

namespace Phizz\Assets\Lol\Rewards\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read CelebrationAssetsCanvasData $canvas
 * @property-read CelebrationAssetsIntroData $intro
 * @property-read CelebrationAssetsTransitionData $transition
 */
class CelebrationAssetsData extends StaticData
{
    protected array $objects = [
        'canvas' => CelebrationAssetsCanvasData::class,
        'intro' => CelebrationAssetsIntroData::class,
        'transition' => CelebrationAssetsTransitionData::class,
    ];
}
