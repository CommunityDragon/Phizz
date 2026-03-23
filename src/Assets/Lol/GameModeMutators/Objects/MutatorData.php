<?php

namespace Phizz\Assets\Lol\GameModeMutators\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read MutatorMutatorData $mutator
 * @property-read string $map_name_override
 */
class MutatorData extends StaticData
{
    protected array $objects = [
        'mutator' => MutatorMutatorData::class,
    ];
}
