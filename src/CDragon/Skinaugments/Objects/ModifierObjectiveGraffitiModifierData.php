<?php

namespace Phizz\CDragon\Skinaugments\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, ModifierObjectiveGraffitiModifierObjectiveVfxData> $objectiveVfxs
 * @property-read mixed|null $resource_bin
 * @property-read ModifierObjectiveGraffitiModifierResourceResolverData $resourceResolver
 * @property-read mixed|null $audio_banks
 */
class ModifierObjectiveGraffitiModifierData extends StaticData
{
    protected array $objects = [
        'resource_resolver' => ModifierObjectiveGraffitiModifierResourceResolverData::class,
    ];

    protected array $collections = [
        'objective_vfxs' => ModifierObjectiveGraffitiModifierObjectiveVfxData::class,
    ];
}
