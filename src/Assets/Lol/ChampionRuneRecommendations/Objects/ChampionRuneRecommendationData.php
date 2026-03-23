<?php

namespace Phizz\Assets\Lol\ChampionRuneRecommendations\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $champion_id
 * @property-read bool $is_override
 * @property-read Collection<int, RuneRecommendationData> $runeRecommendations
 */
class ChampionRuneRecommendationData extends StaticData
{
    protected array $collections = [
        'rune_recommendations' => RuneRecommendationData::class,
    ];
}
