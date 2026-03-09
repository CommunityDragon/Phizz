<?php

namespace Phizz\Apis\Val\ConsoleMatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read Collection<int, PlayerData> $players
 * @property-read Collection<int, CoachData> $coaches
 * @property-read Collection<int, TeamData> $teams
 * @property-read Collection<int, RoundResultData> $roundResults
 * @property-read MatchInfoData $matchInfo
 */
class MatchData extends Data
{
    protected array $collections = [
        'players' => PlayerData::class,
        'coaches' => CoachData::class,
        'teams' => TeamData::class,
        'round_results' => RoundResultData::class,
    ];

    protected array $objects = [
        'match_info' => MatchInfoData::class,
    ];
}
