<?php

namespace Phizz\Apis\Lol\ClashV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $id
 * @property-read int $tournament_id
 * @property-read string $name
 * @property-read int $icon_id
 * @property-read int $tier
 * @property-read string $captain Summoner ID of the team captain.
 * @property-read string $abbreviation
 * @property-read Collection<int, PlayerData> $players Team members.
 */
class TeamData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
    ];
}
