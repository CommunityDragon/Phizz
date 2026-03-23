<?php

namespace Phizz\Assets\Tft\PassAssets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $internal_name
 * @property-read string $icon_texture_path
 * @property-read bool $icon_needs_frame
 */
class PassAssetData extends StaticData
{
    public function iconTextureUrl(): string
    {
        return $this->toUrl($this->icon_texture_path);
    }
}
