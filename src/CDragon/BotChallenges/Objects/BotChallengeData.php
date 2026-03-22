<?php

namespace Phizz\CDragon\BotChallenges\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $category
 * @property-read string $current_level
 * @property-read string $next_level
 * @property-read string $previous_level
 * @property-read int $current_threshold
 * @property-read int $next_threshold
 * @property-read int $previous_threshold
 * @property-read int $previous_value
 * @property-read int $current_value
 * @property-read int $current_level_achieved_time
 */
class BotChallengeData extends StaticData {}
