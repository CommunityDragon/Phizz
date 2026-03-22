<?php

namespace Phizz\CDragon\Tftskilltree\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, RankData> $ranks
 * @property-read string $name
 */
class TftskilltreeData extends StaticData
{
    protected array $collections = [
        'ranks' => RankData::class,
    ];
}
