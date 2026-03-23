<?php

namespace Phizz\Assets\Tft\SkillTree\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, RankSkillData> $skills
 * @property-read int $num_divisions
 * @property-read string $name
 * @property-read string $icon_texture_path
 * @property-read string $celeb_spine_skel_file
 * @property-read string $celeb_spine_atlas_file
 */
class RankData extends StaticData
{
    protected array $collections = [
        'skills' => RankSkillData::class,
    ];

    public function IconTextureUrl(): string
    {
        return $this->toUrl($this->icon_texture_path);
    }
}
