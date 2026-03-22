<?php

namespace Phizz\CDragon\StrawberryHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $title
 * @property-read string $details
 * @property-read EoGNarrativeBarkValueRewardGroupRewardMediaData $media
 * @property-read string $item_id
 * @property-read EoGNarrativeBarkValueRewardGroupRewardItemTypeData $itemType
 */
class EoGNarrativeBarkValueRewardGroupRewardData extends StaticData
{
    protected array $objects = [
        'media' => EoGNarrativeBarkValueRewardGroupRewardMediaData::class,
        'item_type' => EoGNarrativeBarkValueRewardGroupRewardItemTypeData::class,
    ];
}
