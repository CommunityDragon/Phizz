<?php

namespace Phizz\Assets\Tft\DisplayTags\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read TFTFeatureDisplayTagData $tftFeatureDisplayTag
 * @property-read TFTRarityDisplayTagData $tftRarityDisplayTag
 */
class DisplayTagData extends StaticData
{
    protected array $objects = [
        'tft_feature_display_tag' => TFTFeatureDisplayTagData::class,
        'tft_rarity_display_tag' => TFTRarityDisplayTagData::class,
    ];
}
