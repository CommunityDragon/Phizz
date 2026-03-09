<?php

namespace Phizz\Apis\Lor\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read string $deck_id
 * @property-read string $deck_code Code for the deck played. Refer to LOR documentation for details on deck codes.
 * @property-read string $game_outcome
 * @property-read int $order_of_play The order in which the players took turns.
 * @property-read Collection<int, string> $factions
 */
class PlayerData extends Data
{
    protected array $collections = [
        'factions',
    ];
}
