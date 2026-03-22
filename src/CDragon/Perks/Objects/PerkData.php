<?php

namespace Phizz\CDragon\Perks\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $major_change_patch_version
 * @property-read string $tooltip
 * @property-read string $short_desc
 * @property-read string $long_desc
 * @property-read string $recommendation_descriptor
 * @property-read string $icon_path
 * @property-read array $end_of_game_stat_descs
 * @property-read array $recommendation_descriptor_attributes
 */
class PerkData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
