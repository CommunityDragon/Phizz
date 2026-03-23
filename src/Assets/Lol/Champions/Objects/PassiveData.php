<?php

namespace Phizz\Assets\Lol\Champions\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $ability_icon_path
 * @property-read string $ability_video_path
 * @property-read string $ability_video_image_path
 * @property-read string $description
 */
class PassiveData extends StaticData
{
    public function abilityIconUrl(): string
    {
        return $this->toUrl($this->ability_icon_path);
    }
}
