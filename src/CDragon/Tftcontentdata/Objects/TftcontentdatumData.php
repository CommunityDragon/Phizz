<?php

namespace Phizz\CDragon\Tftcontentdata\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read TFTCurrencyData $tftCurrency
 */
class TftcontentdatumData extends StaticData
{
    protected array $objects = [
        'tft_currency' => TFTCurrencyData::class,
    ];
}
