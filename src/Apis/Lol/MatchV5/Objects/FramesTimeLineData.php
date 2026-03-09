<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read array $participant_frames
 * @property-read int $timestamp
 * @property-read Collection<int, EventsTimeLineData> $events
 */
class FramesTimeLineData extends Data
{
    protected array $collections = [
        'events' => EventsTimeLineData::class,
    ];
}
