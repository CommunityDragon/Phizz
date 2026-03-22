<?php

namespace Phizz\CDragon\Tfttrovesbanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read CelebrationThemeCurrencySegmentDataData $currencySegmentData
 * @property-read CelebrationThemePortalSegmentDataData $portalSegmentData
 * @property-read CelebrationThemeHighlightSegmentDataData $highlightSegmentData
 * @property-read CelebrationThemeStandardSegmentDataData $standardSegmentData
 */
class CelebrationThemeData extends StaticData
{
    protected array $objects = [
        'currency_segment_data' => CelebrationThemeCurrencySegmentDataData::class,
        'portal_segment_data' => CelebrationThemePortalSegmentDataData::class,
        'highlight_segment_data' => CelebrationThemeHighlightSegmentDataData::class,
        'standard_segment_data' => CelebrationThemeStandardSegmentDataData::class,
    ];
}
