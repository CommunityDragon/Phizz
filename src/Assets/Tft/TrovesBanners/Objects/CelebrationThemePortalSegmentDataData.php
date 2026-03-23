<?php

namespace Phizz\Assets\Tft\TrovesBanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $single_pull_rare_webm_path
 * @property-read string $single_pull_epic_webm_path
 * @property-read string $single_pull_legendary_webm_path
 * @property-read string $single_pull_mythic_webm_path
 * @property-read string $single_pull_sound_path
 * @property-read string $multi_pull_rare_webm_path
 * @property-read string $multi_pull_epic_webm_path
 * @property-read string $multi_pull_legendary_webm_path
 * @property-read string $multi_pull_mythic_webm_path
 * @property-read string $multi_pull_sound_path
 */
class CelebrationThemePortalSegmentDataData extends StaticData
{
    public function singlePullRareWebmUrl(): string
    {
        return $this->toUrl($this->single_pull_rare_webm_path);
    }

    public function singlePullEpicWebmUrl(): string
    {
        return $this->toUrl($this->single_pull_epic_webm_path);
    }

    public function singlePullLegendaryWebmUrl(): string
    {
        return $this->toUrl($this->single_pull_legendary_webm_path);
    }

    public function singlePullMythicWebmUrl(): string
    {
        return $this->toUrl($this->single_pull_mythic_webm_path);
    }

    public function singlePullSoundUrl(): string
    {
        return $this->toUrl($this->single_pull_sound_path);
    }

    public function multiPullRareWebmUrl(): string
    {
        return $this->toUrl($this->multi_pull_rare_webm_path);
    }

    public function multiPullEpicWebmUrl(): string
    {
        return $this->toUrl($this->multi_pull_epic_webm_path);
    }

    public function multiPullLegendaryWebmUrl(): string
    {
        return $this->toUrl($this->multi_pull_legendary_webm_path);
    }

    public function multiPullMythicWebmUrl(): string
    {
        return $this->toUrl($this->multi_pull_mythic_webm_path);
    }

    public function multiPullSoundUrl(): string
    {
        return $this->toUrl($this->multi_pull_sound_path);
    }
}
