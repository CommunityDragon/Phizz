<?php

namespace Phizz\CDragon\WardSkins\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $ward_image_path
 * @property-read string $ward_shadow_image_path
 * @property-read string $content_id
 * @property-read bool $is_legacy
 * @property-read Collection<int, RegionalDescriptionData> $regionalDescriptions
 * @property-read Collection<int, RarityData> $rarities
 */
class WardSkinData extends StaticData
{
    protected array $collections = [
        'regional_descriptions' => RegionalDescriptionData::class,
        'rarities' => RarityData::class,
    ];

    public function wardImageUrl(): string
    {
        return $this->toUrl($this->ward_image_path);
    }

    public function wardShadowImageUrl(): string
    {
        return $this->toUrl($this->ward_shadow_image_path);
    }
}
