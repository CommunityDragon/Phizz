<?php

namespace Phizz\CDragon\TftchampionsTeamplanner\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $path
 * @property-read string $character_id
 * @property-read int $tier
 * @property-read string $display_name
 * @property-read int $team_planner_code
 * @property-read Collection<int, TFTSet16TraitData> $traits
 * @property-read string $square_icon_path
 * @property-read string $square_splash_icon_path
 */
class TFTSet16Data extends StaticData
{
    protected array $collections = [
        'traits' => TFTSet16TraitData::class,
    ];

    public function squareIconUrl(): string
    {
        return $this->toUrl($this->square_icon_path);
    }

    public function squareSplashIconUrl(): string
    {
        return $this->toUrl($this->square_splash_icon_path);
    }
}
