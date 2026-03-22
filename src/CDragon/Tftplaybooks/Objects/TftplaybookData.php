<?php

namespace Phizz\CDragon\Tftplaybooks\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read int $item_id
 * @property-read string $content_id
 * @property-read string $cap_type_id
 * @property-read string $offer_id
 * @property-read string $alternate_offer_id
 * @property-read string $translated_name
 * @property-read string $translated_description
 * @property-read Collection<int, EarlyAugmentData> $earlyAugments
 * @property-read Collection<int, MidAugmentData> $midAugments
 * @property-read Collection<int, LateAugmentData> $lateAugments
 * @property-read string $loadouts_icon
 * @property-read bool $enabled
 * @property-read string $icon_path
 * @property-read string $icon_path_small
 * @property-read string $splash_path
 * @property-read bool $is_disabled_in_double_up
 */
class TftplaybookData extends StaticData
{
    protected array $collections = [
        'early_augments' => EarlyAugmentData::class,
        'mid_augments' => MidAugmentData::class,
        'late_augments' => LateAugmentData::class,
    ];

    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }

    public function splashUrl(): string
    {
        return $this->toUrl($this->splash_path);
    }
}
