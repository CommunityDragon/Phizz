<?php

namespace Phizz\Assets\Tft\Champions\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read CharacterRecordData $characterRecord
 */
class ChampionData extends StaticData
{
    protected array $objects = [
        'character_record' => CharacterRecordData::class,
    ];
}
