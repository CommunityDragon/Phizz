<?php

namespace Phizz\CDragon\TftpassAssets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $internal_name
 * @property-read string $icon_texture_path
 * @property-read bool $icon_needs_frame
 */
class TftpassAssetData extends StaticData
{
    public function iconTextureUrl(): string
    {
        return $this->toUrl($this->icon_texture_path);
    }
}
