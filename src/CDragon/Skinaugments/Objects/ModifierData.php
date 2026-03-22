<?php

namespace Phizz\CDragon\Skinaugments\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string|null $modifier_type
 * @property-read string|null $centered_lc_overlay_path
 * @property-read string|null $uncentered_lc_overlay_path
 * @property-read string|null $social_card_lc_overlay_path
 * @property-read string|null $tile_lc_overlay_path
 * @property-read ModifierObjectiveGraffitiModifierData $objectiveGraffitiModifier
 * @property-read ModifierEmoteModifierData $emoteModifier
 */
class ModifierData extends StaticData
{
    protected array $objects = [
        'objective_graffiti_modifier' => ModifierObjectiveGraffitiModifierData::class,
        'emote_modifier' => ModifierEmoteModifierData::class,
    ];
}
