<?php

namespace Phizz\Assets\Lol\ChampionSummary\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $alias
 * @property-read string $content_id
 * @property-read string $square_portrait_path
 * @property-read array $roles
 */
class ChampionSummaryData extends StaticData
{
    public function squarePortraitUrl(): string
    {
        return $this->toUrl($this->square_portrait_path);
    }
}
