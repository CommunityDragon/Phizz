<?php

namespace Phizz\Apis\Lol\ChampionV3\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $max_new_player_level
 * @property-read Collection<int, int> $freeChampionIdsForNewPlayers
 * @property-read Collection<int, int> $freeChampionIds
 */
class ChampionInfoData extends Data
{
    protected array $collections = [
        'free_champion_ids_for_new_players',
    ];
}
