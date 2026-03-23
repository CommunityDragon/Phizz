<?php

namespace Phizz\Assets\Lol\ProfileIcons\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $icon_path
 */
class ProfileIconData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
