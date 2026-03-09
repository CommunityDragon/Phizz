<?php

namespace Phizz\Apis\Val\RankedV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $shard The shard for the given leaderboard.
 * @property-read string $act_id The act id for the given leaderboard. Act ids can be found using the val-content API.
 * @property-read int $total_players The total number of players in the leaderboard.
 * @property-read int $immortal_starting_page
 * @property-read int $immortal_starting_index
 * @property-read int $top_tier_rr_threshold
 * @property-read array $tier_details
 * @property-read int $start_index
 * @property-read string $query
 * @property-read Collection<int, PlayerData> $players
 */
class LeaderboardData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
    ];
}
