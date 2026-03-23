<?php

namespace Phizz\Assets\Tft\ContentData\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read TFTCurrencyData $tftCurrency
 */
class ContentDatumData extends StaticData
{
    protected array $objects = [
        'tft_currency' => TFTCurrencyData::class,
    ];
}
