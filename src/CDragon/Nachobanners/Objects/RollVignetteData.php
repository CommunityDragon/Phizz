<?php

namespace Phizz\CDragon\Nachobanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $intro_tier_one_webm_path
 * @property-read string $intro_tier_one_multi_webm_path
 * @property-read string $intro_tier_two_webm_path
 * @property-read string $intro_tier_two_multi_webm_path
 * @property-read string $intro_tier_three_webm_path
 * @property-read string $intro_tier_three_multi_webm_path
 */
class RollVignetteData extends StaticData
{
    public function introTierOneWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_one_webm_path);
    }

    public function introTierOneMultiWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_one_multi_webm_path);
    }

    public function introTierTwoWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_two_webm_path);
    }

    public function introTierTwoMultiWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_two_multi_webm_path);
    }

    public function introTierThreeWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_three_webm_path);
    }

    public function introTierThreeMultiWebmUrl(): string
    {
        return $this->toUrl($this->intro_tier_three_multi_webm_path);
    }
}
