<?php

namespace Phizz\CDragon\Loleosrewards\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $title
 * @property-read string $description
 * @property-read string $tier
 * @property-read string $type
 * @property-read string $override_image_path
 */
class RewardData extends StaticData
{
    public function overrideImageUrl(): string
    {
        return $this->toUrl($this->override_image_path);
    }
}
