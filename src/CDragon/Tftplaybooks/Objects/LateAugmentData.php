<?php

namespace Phizz\CDragon\Tftplaybooks\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $description
 * @property-read string $icon_path
 */
class LateAugmentData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
