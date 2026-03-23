<?php

namespace Phizz\Assets\Lol\Companions\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $content_id
 * @property-read int $item_id
 * @property-read string $name
 * @property-read string $loadouts_icon
 * @property-read string $description
 * @property-read int $level
 * @property-read string $species_name
 * @property-read int $species_id
 * @property-read string $rarity
 * @property-read int $rarity_value
 * @property-read bool $is_default
 * @property-read array $upgrades
 * @property-read bool $tft_only
 * @property-read string $companion_type
 * @property-read string $tft_rarity
 */
class CompanionData extends StaticData {}
