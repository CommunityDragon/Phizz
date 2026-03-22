<?php

namespace Phizz\CDragon\Loot\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read LootBundleContentQueryData $query
 * @property-read string $quantity_expression
 * @property-read string $localized_description
 */
class LootBundleContentData extends StaticData
{
    protected array $objects = [
        'query' => LootBundleContentQueryData::class,
    ];
}
