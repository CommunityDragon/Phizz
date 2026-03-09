<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $score
 * @property-read int $rounds_played
 * @property-read int $kills
 * @property-read int $deaths
 * @property-read int $assists
 * @property-read int $playtime_millis
 * @property-read AbilityCastsData $abilityCasts
 */
class PlayerStatsData extends Data
{
    protected array $objects = [
        'ability_casts' => AbilityCastsData::class,
    ];
}
