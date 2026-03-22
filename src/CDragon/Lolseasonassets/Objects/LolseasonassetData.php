<?php

namespace Phizz\CDragon\Lolseasonassets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $climb_indicator_icon_path
 * @property-read string $climb_indicator_tooltip_loc
 * @property-read string $autofill_emblem_icon_path
 * @property-read string $autofill_info_icon_path
 * @property-read string $autofill_enabled_tooltip_loc
 * @property-read string $autofill_protected_tooltip_loc
 * @property-read string $autofill_modal_title_carry_over_loc
 * @property-read string $autofill_modal_title_dodging_loc
 * @property-read string $autofill_modal_carry_over_desc_loc
 * @property-read string $autofill_modal_dodging_desc_loc
 * @property-read string $autofill_modal_lp_desc_loc
 * @property-read string $lp_change_valor_aegis_icon_tooltip_title_loc
 * @property-read string $lp_change_valor_aegis_icon_tooltip_body_loc
 * @property-read string $lp_change_valor_protection_loc
 * @property-read string $lp_change_valor_bonus_loc
 * @property-read string $valor_aegis_modal_title_loc
 * @property-read string $valor_aegis_priority_role_protection_desc_1
 * @property-read string $valor_aegis_priority_role_protection_desc_2
 * @property-read string $valor_aegis_autofill_protection_desc
 * @property-read string $valor_aegis_rating_change_emblem
 * @property-read string $valor_aegis_emblem_priority_role_large
 * @property-read string $valor_aegis_emblem_autofill_large
 * @property-read string $valor_aegis_awarded_video_autofill_intro
 * @property-read string $valor_aegis_awarded_video_autofill_idle
 * @property-read string $valor_aegis_awarded_video_scarce_intro
 * @property-read string $valor_aegis_awarded_video_scarce_idle
 * @property-read string $valor_aegis_awarded_modal_background
 * @property-read string $valor_aegis_modal_awarded_sfx
 */
class LolseasonassetData extends StaticData
{
    public function climbIndicatorIconUrl(): string
    {
        return $this->toUrl($this->climb_indicator_icon_path);
    }

    public function autofillEmblemIconUrl(): string
    {
        return $this->toUrl($this->autofill_emblem_icon_path);
    }

    public function autofillInfoIconUrl(): string
    {
        return $this->toUrl($this->autofill_info_icon_path);
    }
}
