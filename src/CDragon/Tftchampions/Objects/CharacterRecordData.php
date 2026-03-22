<?php

namespace Phizz\CDragon\Tftchampions\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $path
 * @property-read string $character_id
 * @property-read int $rarity
 * @property-read string $display_name
 * @property-read Collection<int, CharacterRecordTraitData> $traits
 * @property-read string $square_icon_path
 */
class CharacterRecordData extends StaticData
{
    protected array $collections = [
        'traits' => CharacterRecordTraitData::class,
    ];

    public function squareIconUrl(): string
    {
        return $this->toUrl($this->square_icon_path);
    }
}
