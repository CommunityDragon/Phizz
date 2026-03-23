<?php

namespace Phizz\Assets\Tft\TrovesBanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read float $first_item_timing_offset
 * @property-read float $inter_item_timing_offset
 * @property-read string $pc_header_text
 * @property-read string $pc_button_text
 * @property-read string $pc_background_path
 * @property-read string $pc_reward_frame_path
 * @property-read string $pc_reward_one_star_path
 * @property-read string $pc_reward_two_star_path
 * @property-read string $pc_reward_three_star_path
 * @property-read string $pc_reward_rare_gem_path
 * @property-read string $pc_reward_epic_gem_path
 * @property-read string $pc_reward_legendary_gem_path
 * @property-read string $pc_reward_mythic_gem_path
 * @property-read string $pull_single_individual_glint_sound_path
 * @property-read string $pull_single_individual_glint_legendary_sound_path
 * @property-read string $reveal_global_sound_path
 * @property-read string $reveal_epic_sound_path
 * @property-read string $reveal_mythic_sound_path
 * @property-read string $reveal_rare_sound_path
 * @property-read float $pc_reward_fade_in_duration
 * @property-read float $pc_reward_fade_in_delay
 * @property-read float $pc_thumbnail_fade_in_duration
 * @property-read float $pc_thumbnail_fade_in_delay
 * @property-read string $pc_reward_sheen_path
 * @property-read float $pc_reward_sheen_duration
 * @property-read float $pc_reward_sheen_delay
 * @property-read CelebrationThemeStandardSegmentDataPCGlintSpriteData $pcGlintSprite
 * @property-read CelebrationThemeStandardSegmentDataPCLegendarySparkSpriteData $pcLegendarySparkSprite
 * @property-read CelebrationThemeStandardSegmentDataPCLegendaryHitSpriteData $pcLegendaryHitSprite
 */
class CelebrationThemeStandardSegmentDataData extends StaticData
{
    protected array $objects = [
        'pc_glint_sprite' => CelebrationThemeStandardSegmentDataPCGlintSpriteData::class,
        'pc_legendary_spark_sprite' => CelebrationThemeStandardSegmentDataPCLegendarySparkSpriteData::class,
        'pc_legendary_hit_sprite' => CelebrationThemeStandardSegmentDataPCLegendaryHitSpriteData::class,
    ];

    public function PCBackgroundUrl(): string
    {
        return $this->toUrl($this->pc_background_path);
    }

    public function PCRewardFrameUrl(): string
    {
        return $this->toUrl($this->pc_reward_frame_path);
    }

    public function PCRewardOneStarUrl(): string
    {
        return $this->toUrl($this->pc_reward_one_star_path);
    }

    public function PCRewardTwoStarUrl(): string
    {
        return $this->toUrl($this->pc_reward_two_star_path);
    }

    public function PCRewardThreeStarUrl(): string
    {
        return $this->toUrl($this->pc_reward_three_star_path);
    }

    public function PCRewardRareGemUrl(): string
    {
        return $this->toUrl($this->pc_reward_rare_gem_path);
    }

    public function PCRewardEpicGemUrl(): string
    {
        return $this->toUrl($this->pc_reward_epic_gem_path);
    }

    public function PCRewardLegendaryGemUrl(): string
    {
        return $this->toUrl($this->pc_reward_legendary_gem_path);
    }

    public function PCRewardMythicGemUrl(): string
    {
        return $this->toUrl($this->pc_reward_mythic_gem_path);
    }

    public function pullSingleIndividualGlintSoundUrl(): string
    {
        return $this->toUrl($this->pull_single_individual_glint_sound_path);
    }

    public function pullSingleIndividualGlintLegendarySoundUrl(): string
    {
        return $this->toUrl($this->pull_single_individual_glint_legendary_sound_path);
    }

    public function revealGlobalSoundUrl(): string
    {
        return $this->toUrl($this->reveal_global_sound_path);
    }

    public function revealEpicSoundUrl(): string
    {
        return $this->toUrl($this->reveal_epic_sound_path);
    }

    public function revealMythicSoundUrl(): string
    {
        return $this->toUrl($this->reveal_mythic_sound_path);
    }

    public function revealRareSoundUrl(): string
    {
        return $this->toUrl($this->reveal_rare_sound_path);
    }

    public function PCRewardSheenUrl(): string
    {
        return $this->toUrl($this->pc_reward_sheen_path);
    }
}
