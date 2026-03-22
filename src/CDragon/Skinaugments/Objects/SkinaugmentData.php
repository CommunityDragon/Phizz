<?php

namespace Phizz\CDragon\Skinaugments\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $item_id
 * @property-read string $cap_type
 * @property-read string|null $image
 * @property-read Collection<int, ModifierData> $modifiers
 */
class SkinaugmentData extends StaticData
{
    protected array $collections = [
        'modifiers' => ModifierData::class,
    ];
}
