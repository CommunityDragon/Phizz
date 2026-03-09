<?php

namespace Phizz\Apis\Lol\SpectatorV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $perk_style Primary runes path
 * @property-read int $perk_sub_style Secondary runes path
 * @property-read Collection<int, int> $perkIds IDs of the perks/runes assigned.
 */
class PerksData extends Data
{
    protected array $collections = [
        'perk_ids',
    ];
}
