<?php

namespace Phizz\CDragon\CherryLobby\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read ChampionMissionLabelValueData $value
 */
class ChampionMissionLabelData extends StaticData
{
    protected array $objects = [
        'value' => ChampionMissionLabelValueData::class,
    ];
}
