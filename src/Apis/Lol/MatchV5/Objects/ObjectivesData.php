<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read ObjectiveData $baron
 * @property-read ObjectiveData $champion
 * @property-read ObjectiveData $dragon
 * @property-read ObjectiveData $horde
 * @property-read ObjectiveData $inhibitor
 * @property-read ObjectiveData $riftHerald
 * @property-read ObjectiveData $tower
 * @property-read ObjectiveData $atakhan
 */
class ObjectivesData extends Data
{
    protected array $objects = [
        'baron' => ObjectiveData::class,
        'champion' => ObjectiveData::class,
        'dragon' => ObjectiveData::class,
        'horde' => ObjectiveData::class,
        'inhibitor' => ObjectiveData::class,
        'rift_herald' => ObjectiveData::class,
        'tower' => ObjectiveData::class,
        'atakhan' => ObjectiveData::class,
    ];
}
