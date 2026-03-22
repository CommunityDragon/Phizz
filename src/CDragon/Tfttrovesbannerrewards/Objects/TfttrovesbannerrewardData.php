<?php

namespace Phizz\CDragon\Tfttrovesbannerrewards\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $currency_id
 * @property-read string $name
 * @property-read string $rarity
 * @property-read string $tft_rarity
 * @property-read string $reward_texture_path
 * @property-read string $highlight_reward_asset_path
 */
class TfttrovesbannerrewardData extends StaticData
{
    public function rewardTextureUrl(): string
    {
        return $this->toUrl($this->reward_texture_path);
    }

    public function highlightRewardAssetUrl(): string
    {
        return $this->toUrl($this->highlight_reward_asset_path);
    }
}
