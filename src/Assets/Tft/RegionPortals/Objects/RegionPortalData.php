<?php

namespace Phizz\Assets\Tft\RegionPortals\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $icon_path
 * @property-read string $name_id
 * @property-read string $display_name
 * @property-read string $description
 */
class RegionPortalData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
