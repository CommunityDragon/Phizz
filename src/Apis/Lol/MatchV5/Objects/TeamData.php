<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $team_id
 * @property-read bool $win
 * @property-read Collection<int, BanData> $bans
 * @property-read ObjectivesData $objectives
 * @property-read FeatsData $feats
 */
class TeamData extends Data
{
    protected array $collections = [
        'bans' => BanData::class,
    ];

    protected array $objects = [
        'objectives' => ObjectivesData::class,
        'feats' => FeatsData::class,
    ];
}
