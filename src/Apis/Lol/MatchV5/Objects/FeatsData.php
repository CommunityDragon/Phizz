<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read FeatData $epicMonsterKill
 * @property-read FeatData $firstBlood
 * @property-read FeatData $firstTurret
 */
class FeatsData extends Data
{
    protected array $objects = [
        'epic_monster_kill' => FeatData::class,
        'first_blood' => FeatData::class,
        'first_turret' => FeatData::class,
    ];
}
