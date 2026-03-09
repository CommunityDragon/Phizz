<?php

namespace Phizz\Apis\Tft\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $name Trait name.
 * @property-read int $num_units Number of units with this trait.
 * @property-read int $style Current style for this trait. (0 = No style, 1 = Bronze, 2 = Silver, 3 = Gold, 4 = Chromatic)
 * @property-read int $tier_current Current active tier for the trait.
 * @property-read int $tier_total Total tiers for the trait.
 */
class TraitData extends Data {}
