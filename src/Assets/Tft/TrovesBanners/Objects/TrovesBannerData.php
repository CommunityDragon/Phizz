<?php

namespace Phizz\Assets\Tft\TrovesBanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $banner_currency_id
 * @property-read string $activation_time
 * @property-read string $deactivation_time
 * @property-read string $pity_counter_id
 * @property-read mixed|null $root_table
 * @property-read mixed|null $chase_table
 * @property-read int $pity_threshold
 * @property-read string $banner_texture
 * @property-read string $thumbnail_texture
 * @property-read string $background_texture
 * @property-read string $platform_texture
 * @property-read string $event_hub_banner_texture
 * @property-read string $name
 * @property-read string $description
 * @property-read CelebrationThemeData $celebrationTheme
 * @property-read bool $is_collector_bounty
 */
class TrovesBannerData extends StaticData
{
    protected array $objects = [
        'celebration_theme' => CelebrationThemeData::class,
    ];
}
