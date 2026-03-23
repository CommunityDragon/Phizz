<?php

namespace Phizz\Assets\Tft\TrovesBanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $lottie_json_path
 * @property-read string $reveal_sound_path
 * @property-read string $transition_wipe_sound_path
 */
class CelebrationThemeHighlightSegmentDataData extends StaticData
{
    public function lottieJsonUrl(): string
    {
        return $this->toUrl($this->lottie_json_path);
    }

    public function revealSoundUrl(): string
    {
        return $this->toUrl($this->reveal_sound_path);
    }

    public function transitionWipeSoundUrl(): string
    {
        return $this->toUrl($this->transition_wipe_sound_path);
    }
}
