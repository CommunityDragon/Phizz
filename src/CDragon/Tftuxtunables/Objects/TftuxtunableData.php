<?php

namespace Phizz\CDragon\Tftuxtunables\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, TFTPartnerGroupColorData> $tftPartnerGroupColors
 */
class TftuxtunableData extends StaticData
{
    protected array $collections = [
        'tft_partner_group_colors' => TFTPartnerGroupColorData::class,
    ];
}
