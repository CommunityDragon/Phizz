<?php

namespace Phizz\CDragon\Tftchampions\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read CharacterRecordData $characterRecord
 */
class TftchampionData extends StaticData
{
    protected array $objects = [
        'character_record' => CharacterRecordData::class,
    ];
}
