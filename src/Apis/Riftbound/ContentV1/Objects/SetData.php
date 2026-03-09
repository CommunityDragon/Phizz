<?php

namespace Phizz\Apis\Riftbound\ContentV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $id Set ID
 * @property-read string $name Set Name
 * @property-read Collection<int, CardData> $cards
 */
class SetData extends Data
{
    protected array $collections = [
        'cards' => CardData::class,
    ];
}
