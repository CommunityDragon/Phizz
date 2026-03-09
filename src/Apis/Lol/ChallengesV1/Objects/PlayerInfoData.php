<?php

namespace Phizz\Apis\Lol\ChallengesV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read array $category_points
 * @property-read Collection<int, ChallengeInfoData> $challenges
 * @property-read PlayerClientPreferencesData $preferences
 * @property-read ChallengePointData $totalPoints
 */
class PlayerInfoData extends Data
{
    protected array $collections = [
        'challenges' => ChallengeInfoData::class,
    ];

    protected array $objects = [
        'preferences' => PlayerClientPreferencesData::class,
        'total_points' => ChallengePointData::class,
    ];
}
