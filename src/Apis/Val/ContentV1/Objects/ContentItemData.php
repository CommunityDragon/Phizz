<?php

namespace Phizz\Apis\Val\ContentV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $name
 * @property-read string $id
 * @property-read string $asset_name
 * @property-read string $asset_path This field is only included for maps and game modes. These values are used in the match response.
 * @property-read LocalizedNamesData $localizedNames
 */
class ContentItemData extends Data
{
    protected array $objects = [
        'localized_names' => LocalizedNamesData::class,
    ];
}
