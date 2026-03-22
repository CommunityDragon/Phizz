<?php

namespace Phizz\CDragon\Loot\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $image
 * @property-read string $start_date
 * @property-read string $end_date
 * @property-read int $mapped_store_id
 * @property-read int $lifetime_max
 * @property-read bool $auto_redeem
 * @property-read string $rarity
 * @property-read string $type
 */
class LootItemData extends StaticData {}
