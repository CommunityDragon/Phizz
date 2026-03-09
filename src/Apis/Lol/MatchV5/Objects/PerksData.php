<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read Collection<int, PerkStyleData> $styles
 * @property-read PerkStatsData $statPerks
 */
class PerksData extends Data
{
    protected array $collections = [
        'styles' => PerkStyleData::class,
    ];

    protected array $objects = [
        'stat_perks' => PerkStatsData::class,
    ];
}
