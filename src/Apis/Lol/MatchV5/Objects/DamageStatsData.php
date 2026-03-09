<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $magic_damage_done
 * @property-read int $magic_damage_done_to_champions
 * @property-read int $magic_damage_taken
 * @property-read int $physical_damage_done
 * @property-read int $physical_damage_done_to_champions
 * @property-read int $physical_damage_taken
 * @property-read int $total_damage_done
 * @property-read int $total_damage_done_to_champions
 * @property-read int $total_damage_taken
 * @property-read int $true_damage_done
 * @property-read int $true_damage_done_to_champions
 * @property-read int $true_damage_taken
 */
class DamageStatsData extends Data {}
