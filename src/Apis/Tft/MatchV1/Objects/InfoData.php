<?php

namespace Phizz\Apis\Tft\MatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $end_of_game_result
 * @property-read int $game_creation
 * @property-read int $game_id
 * @property-read int $game_datetime Unix timestamp.
 * @property-read float $game_length Game length in seconds.
 * @property-read string $game_version Game client version.
 * @property-read string $game_variation Deprecated. Game variation key. Game variations documented in TFT static data.
 * @property-read int $map_id
 * @property-read int $queue_id Please refer to the League of Legends documentation.
 * @property-read int $queue_id Please refer to the League of Legends documentation.
 * @property-read string $tft_game_type
 * @property-read string $tft_set_core_name
 * @property-read int $tft_set_number Teamfight Tactics set number.
 * @property-read Collection<int, ParticipantData> $participants
 */
class InfoData extends Data
{
    protected array $collections = [
        'participants' => ParticipantData::class,
    ];
}
