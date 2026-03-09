<?php

namespace Phizz\Apis\Lol\ChallengesV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read float $percentile
 * @property-read int $players_in_level
 * @property-read int $achieved_time
 * @property-read float $value
 * @property-read int $challenge_id
 * @property-read string $level (Legal values:  NONE,  IRON,  BRONZE,  SILVER,  GOLD,  PLATINUM,  DIAMOND,  MASTER,  GRANDMASTER,  CHALLENGER,  HIGHEST_NOT_LEADERBOARD_ONLY,  HIGHEST,  LOWEST)
 * @property-read int $position
 */
class ChallengeInfoData extends Data {}
