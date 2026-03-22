<?php

namespace Phizz\CDragon\Tftcontentdata\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read TFTCurrencyContentDataData $contentData
 */
class TFTCurrencyData extends StaticData
{
    protected array $objects = [
        'content_data' => TFTCurrencyContentDataData::class,
    ];
}
