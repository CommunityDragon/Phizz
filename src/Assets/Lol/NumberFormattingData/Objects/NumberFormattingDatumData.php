<?php

namespace Phizz\Assets\Lol\NumberFormattingData\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $decimal_seperator
 * @property-read string $thousand_seperator
 * @property-read string $thousand_abbreviation
 * @property-read string $ten_thousand_abbreviation
 * @property-read string $million_abbreviation
 * @property-read string $one_hundred_million_abbreviation
 * @property-read string $billion_abbreviation
 * @property-read string $trillion_abbreviation
 * @property-read string $second_abbreviation
 * @property-read string $minute_abbreviation
 * @property-read string $hour_abbreviation
 * @property-read string $meters_abbreviation
 * @property-read string $kilometers_abbreviation
 * @property-read string $percentage_format
 * @property-read NumberFormattingBehaviorData $numberFormattingBehavior
 */
class NumberFormattingDatumData extends StaticData
{
    protected array $objects = [
        'number_formatting_behavior' => NumberFormattingBehaviorData::class,
    ];
}
