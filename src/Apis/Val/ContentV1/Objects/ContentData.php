<?php

namespace Phizz\Apis\Val\ContentV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $version
 * @property-read Collection<int, ContentItemData> $characters
 * @property-read Collection<int, ContentItemData> $maps
 * @property-read Collection<int, ContentItemData> $chromas
 * @property-read Collection<int, ContentItemData> $skins
 * @property-read Collection<int, ContentItemData> $skinLevels
 * @property-read Collection<int, ContentItemData> $equips
 * @property-read Collection<int, ContentItemData> $gameModes
 * @property-read Collection<int, ContentItemData> $sprays
 * @property-read Collection<int, ContentItemData> $sprayLevels
 * @property-read Collection<int, ContentItemData> $charms
 * @property-read Collection<int, ContentItemData> $charmLevels
 * @property-read Collection<int, ContentItemData> $playerCards
 * @property-read Collection<int, ContentItemData> $playerTitles
 * @property-read Collection<int, ActData> $acts
 * @property-read Collection<int, ContentItemData> $ceremonies
 * @property-read Collection<int, ContentItemData> $totems
 */
class ContentData extends Data
{
    protected array $collections = [
        'characters' => ContentItemData::class,
        'maps' => ContentItemData::class,
        'chromas' => ContentItemData::class,
        'skins' => ContentItemData::class,
        'skin_levels' => ContentItemData::class,
        'equips' => ContentItemData::class,
        'game_modes' => ContentItemData::class,
        'sprays' => ContentItemData::class,
        'spray_levels' => ContentItemData::class,
        'charms' => ContentItemData::class,
        'charm_levels' => ContentItemData::class,
        'player_cards' => ContentItemData::class,
        'player_titles' => ContentItemData::class,
        'acts' => ActData::class,
        'ceremonies' => ContentItemData::class,
        'totems' => ContentItemData::class,
    ];
}
