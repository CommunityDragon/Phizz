<?php

namespace Phizz\CDragon\SummonerTrophies\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, TrophyData> $trophies
 * @property-read Collection<int, TrophyPedestalData> $trophyPedestals
 */
class SummonerTrophyData extends StaticData
{
    protected array $collections = [
        'trophies' => TrophyData::class,
        'trophy_pedestals' => TrophyPedestalData::class,
    ];
}
