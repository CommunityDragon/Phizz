<?php

namespace Phizz\Assets\Lol\ChampionRuneRecommendations\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $position
 * @property-read int $map_id
 * @property-read bool $is_default_position
 * @property-read int $min_summoner_level
 * @property-read array $perk_ids
 * @property-read int $primary_perk_style_id
 * @property-read int $secondary_perk_style_id
 * @property-read array $summoner_spell_ids
 * @property-read string $recommendation_id
 */
class RuneRecommendationData extends StaticData {}
