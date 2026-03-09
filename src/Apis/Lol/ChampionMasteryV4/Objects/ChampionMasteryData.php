<?php

namespace Phizz\Apis\Lol\ChampionMasteryV4\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $puuid Player Universal Unique Identifier. Exact length of 78 characters. (Encrypted)
 * @property-read int $champion_points_until_next_level Number of points needed to achieve next level. Zero if player reached maximum champion level for this champion.
 * @property-read bool $chest_granted Is chest granted for this champion or not in current season.
 * @property-read int $champion_id Champion ID for this entry.
 * @property-read int $last_play_time Last time this champion was played by this player - in Unix milliseconds time format.
 * @property-read int $champion_level Champion level for specified player and champion combination.
 * @property-read int $champion_points Total number of champion points for this player and champion combination - they are used to determine championLevel.
 * @property-read int $champion_points_since_last_level Number of points earned since current level has been achieved.
 * @property-read int $mark_required_for_next_level
 * @property-read int $champion_season_milestone
 * @property-read int $tokens_earned The token earned for this champion at the current championLevel. When the championLevel is advanced the tokensEarned resets to 0.
 * @property-read Collection<int, string> $milestoneGrades
 * @property-read NextSeasonMilestonesData $nextSeasonMilestone This object contains required next season milestone information.
 */
class ChampionMasteryData extends Data
{
    protected array $collections = [
        'milestone_grades',
    ];

    protected array $objects = [
        'next_season_milestone' => NextSeasonMilestonesData::class,
    ];
}
