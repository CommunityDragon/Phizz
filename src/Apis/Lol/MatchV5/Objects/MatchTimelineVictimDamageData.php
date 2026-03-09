<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read bool $basic
 * @property-read int $magic_damage
 * @property-read string $name
 * @property-read int $participant_id
 * @property-read int $physical_damage
 * @property-read string $spell_name
 * @property-read int $spell_slot
 * @property-read int $true_damage
 * @property-read string $type
 */
class MatchTimelineVictimDamageData extends Data {}
