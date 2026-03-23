<?php

namespace Phizz\Assets\Tft\SkillTree\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, RankData> $ranks
 * @property-read string $name
 */
class SkillTreeData extends StaticData
{
    protected array $collections = [
        'ranks' => RankData::class,
    ];
}
