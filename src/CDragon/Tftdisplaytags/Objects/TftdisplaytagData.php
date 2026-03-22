<?php

namespace Phizz\CDragon\Tftdisplaytags\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read TFTFeatureDisplayTagData $tftFeatureDisplayTag
 * @property-read TFTRarityDisplayTagData $tftRarityDisplayTag
 */
class TftdisplaytagData extends StaticData
{
    protected array $objects = [
        'tft_feature_display_tag' => TFTFeatureDisplayTagData::class,
        'tft_rarity_display_tag' => TFTRarityDisplayTagData::class,
    ];
}
