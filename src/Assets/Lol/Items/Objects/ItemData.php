<?php

namespace Phizz\Assets\Lol\Items\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $description
 * @property-read bool $active
 * @property-read bool $in_store
 * @property-read array $from
 * @property-read array $to
 * @property-read array $categories
 * @property-read int $max_stacks
 * @property-read string $required_champion
 * @property-read string $required_ally
 * @property-read string $required_buff_currency_name
 * @property-read int $required_buff_currency_cost
 * @property-read int $special_recipe
 * @property-read bool $is_enchantment
 * @property-read int $price
 * @property-read int $price_total
 * @property-read bool $display_in_item_sets
 * @property-read string $icon_path
 */
class ItemData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
