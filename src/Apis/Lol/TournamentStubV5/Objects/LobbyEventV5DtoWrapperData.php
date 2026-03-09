<?php

namespace Phizz\Apis\Lol\TournamentStubV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read Collection<int, LobbyEventV5Data> $eventList
 */
class LobbyEventV5DtoWrapperData extends Data
{
    protected array $collections = [
        'event_list' => LobbyEventV5Data::class,
    ];
}
