<?php

namespace Phizz\Apis\Lol\TournamentStubV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $timestamp Timestamp from the event
 * @property-read string $event_type The type of event that was triggered
 * @property-read string $puuid The puuid that triggered the event (Encrypted)
 */
class LobbyEventV5Data extends Data {}
