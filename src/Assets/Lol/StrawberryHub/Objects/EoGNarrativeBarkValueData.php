<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read EoGNarrativeBarkValueRewardGroupData $rewardGroup
 * @property-read string $title
 * @property-read string $sub_header
 * @property-read string $content
 * @property-read string $detail_text_line_1
 * @property-read string $detail_text_line_2
 * @property-read string $detail_text_line_3
 * @property-read string $image
 * @property-read string $icon_image
 * @property-read bool $is_primordian
 */
class EoGNarrativeBarkValueData extends StaticData
{
    protected array $objects = [
        'reward_group' => EoGNarrativeBarkValueRewardGroupData::class,
    ];
}
