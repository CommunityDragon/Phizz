<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read ParticipantFrameData $one9
 */
class ParticipantFramesData extends Data
{
    protected array $objects = [
        'one_9' => ParticipantFrameData::class,
    ];
}
