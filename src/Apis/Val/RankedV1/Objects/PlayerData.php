<?php

namespace Phizz\Apis\Val\RankedV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid This field may be omitted if the player has been anonymized.
 * @property-read string $game_name This field may be omitted if the player has been anonymized.
 * @property-read string $tag_line This field may be omitted if the player has been anonymized.
 * @property-read int $leaderboard_rank
 * @property-read int $ranked_rating
 * @property-read int $number_of_wins
 * @property-read int $competitive_tier
 * @property-read string $prefix
 * @property-read string $premier_roster_type
 */
class PlayerData extends Data {}
