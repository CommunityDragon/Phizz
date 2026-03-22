<?php

namespace Phizz\CDragon\Perkstyles\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $tooltip
 * @property-read string $icon_path
 * @property-read StyleAssetMapData $assetMap
 * @property-read bool $is_advanced
 * @property-read array $allowed_sub_styles
 * @property-read Collection<int, StyleSubStyleBonuData> $subStyleBonus
 * @property-read Collection<int, StyleSlotData> $slots
 * @property-read string $default_page_name
 * @property-read int $default_sub_style
 * @property-read array $default_perks
 * @property-read array $default_perks_when_splashed
 * @property-read Collection<int, StyleDefaultStatModsPerSubStyleData> $defaultStatModsPerSubStyle
 */
class StyleData extends StaticData
{
    protected array $objects = [
        'asset_map' => StyleAssetMapData::class,
    ];

    protected array $collections = [
        'sub_style_bonus' => StyleSubStyleBonuData::class,
        'slots' => StyleSlotData::class,
        'default_stat_mods_per_sub_style' => StyleDefaultStatModsPerSubStyleData::class,
    ];

    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
