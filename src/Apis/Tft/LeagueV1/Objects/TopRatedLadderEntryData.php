<?php

namespace Phizz\Apis\Tft\LeagueV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid Player's encrypted puuid.
 * @property-read string $rated_tier (Legal values:  ORANGE,  PURPLE,  BLUE,  GREEN,  GRAY)
 * @property-read int $rated_rating
 * @property-read int $wins First placement.
 * @property-read int $previous_update_ladder_position
 */
class TopRatedLadderEntryData extends Data {}
