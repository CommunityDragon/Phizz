<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $end_of_game_result Refer to indicate if the game ended in termination.
 * @property-read int $frame_interval
 * @property-read int $game_id
 * @property-read Collection<int, ParticipantTimeLineData> $participants
 * @property-read Collection<int, FramesTimeLineData> $frames
 */
class InfoTimeLineData extends Data
{
    protected array $collections = [
        'participants' => ParticipantTimeLineData::class,
        'frames' => FramesTimeLineData::class,
    ];
}
