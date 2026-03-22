<?php

namespace Phizz\CDragon\Nachobanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read ChasePityCounterData $chasePityCounter
 * @property-read HighlightPityCounterData $highlightPityCounter
 * @property-read int $chase_pity_threshold
 * @property-read int $highlight_pity_threshold
 * @property-read string $banner_background_texture
 * @property-read string $banner_background_parallax
 * @property-read string $banner_chase_animation_webm_path
 * @property-read string $banner_chase_animation_parallax
 * @property-read string $roll_vignette_skin_intro_webm_path
 * @property-read string $roll_vignette_skin_intro_sfx_path
 * @property-read string $chase_celebration_intro_webm_path
 * @property-read ChaseCelebrationVoData $chaseCelebrationVo
 * @property-read HubIntroVoData $hubIntroVo
 * @property-read RollVignetteData $rollVignette
 * @property-read BannerSkinData $bannerSkin
 * @property-read BannerCurrencyData $bannerCurrency
 */
class NachobannerData extends StaticData
{
    protected array $objects = [
        'chase_pity_counter' => ChasePityCounterData::class,
        'highlight_pity_counter' => HighlightPityCounterData::class,
        'chase_celebration_vo' => ChaseCelebrationVoData::class,
        'hub_intro_vo' => HubIntroVoData::class,
        'roll_vignette' => RollVignetteData::class,
        'banner_skin' => BannerSkinData::class,
        'banner_currency' => BannerCurrencyData::class,
    ];

    public function bannerChaseAnimationWebmUrl(): string
    {
        return $this->toUrl($this->banner_chase_animation_webm_path);
    }

    public function rollVignetteSkinIntroWebmUrl(): string
    {
        return $this->toUrl($this->roll_vignette_skin_intro_webm_path);
    }

    public function rollVignetteSkinIntroSfxUrl(): string
    {
        return $this->toUrl($this->roll_vignette_skin_intro_sfx_path);
    }

    public function chaseCelebrationIntroWebmUrl(): string
    {
        return $this->toUrl($this->chase_celebration_intro_webm_path);
    }
}
