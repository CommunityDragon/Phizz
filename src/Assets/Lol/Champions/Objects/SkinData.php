<?php

namespace Phizz\Assets\Lol\Champions\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $content_id
 * @property-read bool $is_base
 * @property-read string $name
 * @property-read string $skin_classification
 * @property-read string $splash_path
 * @property-read string $uncentered_splash_path
 * @property-read string $tile_path
 * @property-read string $load_screen_path
 * @property-read string $skin_type
 * @property-read string $rarity
 * @property-read bool $is_legacy
 * @property-read mixed|null $splash_video_path
 * @property-read mixed|null $preview_video_url
 * @property-read mixed|null $collection_splash_video_path
 * @property-read mixed|null $collection_card_hover_video_path
 * @property-read mixed|null $features_text
 * @property-read mixed|null $chroma_path
 * @property-read mixed|null $emblems
 * @property-read int $region_rarity_id
 * @property-read mixed|null $rarity_gem_path
 * @property-read Collection<int, SkinSkinLineData> $skinLines
 * @property-read string|null $description
 */
class SkinData extends StaticData
{
    protected array $collections = [
        'skin_lines' => SkinSkinLineData::class,
    ];

    public function splashUrl(): string
    {
        return $this->toUrl($this->splash_path);
    }

    public function uncenteredSplashUrl(): string
    {
        return $this->toUrl($this->uncentered_splash_path);
    }

    public function tileUrl(): string
    {
        return $this->toUrl($this->tile_path);
    }

    public function loadScreenUrl(): string
    {
        return $this->toUrl($this->load_screen_path);
    }
}
