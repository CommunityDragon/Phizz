<?php

namespace Phizz\Assets\Lol\Loot\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $loot_item_name
 * @property-read string $backsplash_image_path
 * @property-read string $button_text
 * @property-read string $non_premium_cap_currency_id
 * @property-read string $premium_cap_currency_id
 * @property-read string $title_text
 * @property-read string $token_icon_path
 * @property-read string $tooltip_description_text
 * @property-read string $tooltip_splash_path
 * @property-read string $tooltip_title_text
 * @property-read string $unlock_item_id
 * @property-read string $unlock_item_type
 * @property-read string $activation_date
 * @property-read string $deactivation_date
 * @property-read string $store_link_item
 * @property-read string $store_link_type
 */
class LootTokenBankCardData extends StaticData
{
    public function backsplashImageUrl(): string
    {
        return $this->toUrl($this->backsplash_image_path);
    }

    public function tokenIconUrl(): string
    {
        return $this->toUrl($this->token_icon_path);
    }

    public function tooltipSplashUrl(): string
    {
        return $this->toUrl($this->tooltip_splash_path);
    }
}
