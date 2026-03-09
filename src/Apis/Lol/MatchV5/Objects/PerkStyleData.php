<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $description
 * @property-read int $style
 * @property-read Collection<int, PerkStyleSelectionData> $selections
 */
class PerkStyleData extends Data
{
    protected array $collections = [
        'selections' => PerkStyleSelectionData::class,
    ];
}
