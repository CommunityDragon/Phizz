<?php

namespace Phizz\Apis\Val\ContentV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $name
 * @property-read string $id
 * @property-read bool $is_active
 * @property-read string $parent_id
 * @property-read string $type
 * @property-read LocalizedNamesData $localizedNames
 */
class ActData extends Data
{
    protected array $objects = [
        'localized_names' => LocalizedNamesData::class,
    ];
}
