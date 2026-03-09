<?php

namespace Phizz\Apis\Lol\ChallengesV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $id
 * @property-read array $localized_names
 * @property-read string $state DISABLED - not visible and not calculated, HIDDEN - not visible, but calculated, ENABLED - visible and calculated, ARCHIVED - visible, but not calculated
 * @property-read string $tracking LIFETIME - stats are incremented without reset, SEASON - stats are accumulated by season and reset at the beginning of new season
 * @property-read int $start_timestamp
 * @property-read int $end_timestamp
 * @property-read bool $leaderboard
 * @property-read array $thresholds
 */
class ChallengeConfigInfoData extends Data {}
