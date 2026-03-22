<?php

namespace Phizz\CDragon\Champions\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $spell_key
 * @property-read string $name
 * @property-read string $ability_icon_path
 * @property-read string $ability_video_path
 * @property-read string $ability_video_image_path
 * @property-read string $cost
 * @property-read string $cooldown
 * @property-read string $description
 * @property-read string $dynamic_description
 * @property-read array $range
 * @property-read array $cost_coefficients
 * @property-read array $cooldown_coefficients
 * @property-read SpellCoefficientsData $coefficients
 * @property-read SpellEffectAmountsData $effectAmounts
 * @property-read SpellAmmoData $ammo
 * @property-read int $max_level
 */
class SpellData extends StaticData
{
    protected array $objects = [
        'coefficients' => SpellCoefficientsData::class,
        'effect_amounts' => SpellEffectAmountsData::class,
        'ammo' => SpellAmmoData::class,
    ];

    public function abilityIconUrl(): string
    {
        return $this->toUrl($this->ability_icon_path);
    }
}
