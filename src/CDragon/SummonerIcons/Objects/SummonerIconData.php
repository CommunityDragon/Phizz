<?php

namespace Phizz\CDragon\SummonerIcons\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $content_id
 * @property-read string $title
 * @property-read int $year_released
 * @property-read bool $is_legacy
 * @property-read string $image_path
 * @property-read Collection<int, DescriptionData> $descriptions
 * @property-read Collection<int, RarityData> $rarities
 * @property-read array $disabled_regions
 */
class SummonerIconData extends StaticData
{
    protected array $collections = [
        'descriptions' => DescriptionData::class,
        'rarities' => RarityData::class,
    ];

    public function imageUrl(): string
    {
        return $this->toUrl($this->image_path);
    }
}
