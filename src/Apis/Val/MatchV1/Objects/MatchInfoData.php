<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $match_id
 * @property-read string $map_id
 * @property-read string $game_version
 * @property-read int $game_length_millis
 * @property-read string $region
 * @property-read int $game_start_millis
 * @property-read string $provisioning_flow_id
 * @property-read bool $is_completed
 * @property-read string $custom_game_name
 * @property-read string $queue_id
 * @property-read string $game_mode
 * @property-read bool $is_ranked
 * @property-read string $season_id
 * @property-read array $premier_match_info
 */
class MatchInfoData extends Data {}
