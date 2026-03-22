<?php

namespace Phizz\CDragon\GameModeMutators\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $map_id
 * @property-read Collection<int, MutatorData> $mutators
 * @property-read string $map_name_base
 */
class GameModeMutatorData extends StaticData
{
    protected array $collections = [
        'mutators' => MutatorData::class,
    ];
}
