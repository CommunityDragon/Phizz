<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read int $score
 * @property-read Collection<int, KillData> $kills
 * @property-read Collection<int, DamageData> $damage
 * @property-read EconomyData $economy
 * @property-read AbilityData $ability
 */
class PlayerRoundStatsData extends Data
{
    protected array $collections = [
        'kills' => KillData::class,
        'damage' => DamageData::class,
    ];

    protected array $objects = [
        'economy' => EconomyData::class,
        'ability' => AbilityData::class,
    ];
}
