<?php

namespace Phizz\CDragon\Tfttrovesbanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $lottie_json_path
 * @property-read string $single_pull_sound_path
 * @property-read string $multi_pull_sound_path
 * @property-read string $mythic_pull_sound_path
 */
class CelebrationThemeCurrencySegmentDataData extends StaticData
{
    public function lottieJsonUrl(): string
    {
        return $this->toUrl($this->lottie_json_path);
    }

    public function singlePullSoundUrl(): string
    {
        return $this->toUrl($this->single_pull_sound_path);
    }

    public function multiPullSoundUrl(): string
    {
        return $this->toUrl($this->multi_pull_sound_path);
    }

    public function mythicPullSoundUrl(): string
    {
        return $this->toUrl($this->mythic_pull_sound_path);
    }
}
