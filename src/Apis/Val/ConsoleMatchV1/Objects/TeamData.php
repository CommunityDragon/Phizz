<?php

namespace Phizz\Apis\Val\ConsoleMatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $team_id This is an arbitrary string. Red and Blue in bomb modes. The puuid of the player in deathmatch.
 * @property-read bool $won
 * @property-read int $rounds_played
 * @property-read int $rounds_won
 * @property-read int $num_points Team points scored. Number of kills in deathmatch.
 */
class TeamData extends Data {}
