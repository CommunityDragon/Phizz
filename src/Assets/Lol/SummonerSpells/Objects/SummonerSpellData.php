<?php

namespace Phizz\Assets\Lol\SummonerSpells\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $description
 * @property-read int $summoner_level
 * @property-read int $cooldown
 * @property-read array $game_modes
 * @property-read string $icon_path
 */
class SummonerSpellData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
