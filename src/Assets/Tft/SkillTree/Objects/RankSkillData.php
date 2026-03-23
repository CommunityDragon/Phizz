<?php

namespace Phizz\Assets\Tft\SkillTree\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $description
 * @property-read string $content_id
 * @property-read int $item_id
 * @property-read string $icon_texture_path
 */
class RankSkillData extends StaticData
{
    public function IconTextureUrl(): string
    {
        return $this->toUrl($this->icon_texture_path);
    }
}
