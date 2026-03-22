<?php

namespace Phizz\CDragon\CherryAugments\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name_tra
 * @property-read string $augment_small_icon_path
 * @property-read string $rarity
 */
class CherryAugmentData extends StaticData
{
    public function augmentSmallIconUrl(): string
    {
        return $this->toUrl($this->augment_small_icon_path);
    }
}
