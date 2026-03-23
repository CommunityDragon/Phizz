<?php

namespace Phizz\Assets\Tft\Traits\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $display_name
 * @property-read string $trait_id
 * @property-read string $set
 * @property-read string $icon_path
 * @property-read string $tooltip_text
 * @property-read array $innate_trait_sets
 * @property-read Collection<int, ConditionalTraitSetData> $conditionalTraitSets
 */
class TraitData extends StaticData
{
    protected array $collections = [
        'conditional_trait_sets' => ConditionalTraitSetData::class,
    ];
}
