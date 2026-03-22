<?php

namespace Phizz\CDragon\Loot\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, LootItemData> $lootItems
 * @property-read Collection<int, LootRecipeData> $lootRecipes
 * @property-read Collection<int, LootTableData> $lootTables
 * @property-read Collection<int, LootBundleData> $lootBundles
 * @property-read Collection<int, LootTokenBankCardData> $lootTokenBankCards
 */
class LootData extends StaticData
{
    protected array $collections = [
        'loot_items' => LootItemData::class,
        'loot_recipes' => LootRecipeData::class,
        'loot_tables' => LootTableData::class,
        'loot_bundles' => LootBundleData::class,
        'loot_token_bank_cards' => LootTokenBankCardData::class,
    ];
}
