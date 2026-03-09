<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $ability_haste
 * @property-read int $ability_power
 * @property-read int $armor
 * @property-read int $armor_pen
 * @property-read int $armor_pen_percent
 * @property-read int $attack_damage
 * @property-read int $attack_speed
 * @property-read int $bonus_armor_pen_percent
 * @property-read int $bonus_magic_pen_percent
 * @property-read int $cc_reduction
 * @property-read int $cooldown_reduction
 * @property-read int $health
 * @property-read int $health_max
 * @property-read int $health_regen
 * @property-read int $lifesteal
 * @property-read int $magic_pen
 * @property-read int $magic_pen_percent
 * @property-read int $magic_resist
 * @property-read int $movement_speed
 * @property-read int $omnivamp
 * @property-read int $physical_vamp
 * @property-read int $power
 * @property-read int $power_max
 * @property-read int $power_regen
 * @property-read int $spell_vamp
 */
class ChampionStatsData extends Data {}
