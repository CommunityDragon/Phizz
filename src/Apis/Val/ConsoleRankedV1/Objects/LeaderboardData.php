<?php

namespace Phizz\Apis\Val\ConsoleRankedV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $act_id The act id for the given leaderboard. Act ids can be found using the val-content API.
 * @property-read int $total_players The total number of players in the leaderboard.
 * @property-read string $query
 * @property-read string $shard The shard for the given leaderboard.
 * @property-read Collection<int, PlayerData> $players
 * @property-read Collection<int, TierData> $tierDetails
 */
class LeaderboardData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
        'tier_details' => TierData::class,
    ];
}
