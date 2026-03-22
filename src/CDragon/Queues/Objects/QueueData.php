<?php

namespace Phizz\CDragon\Queues\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $short_name
 * @property-read string $description
 * @property-read string $detailed_description
 * @property-read string $game_select_mode_group
 * @property-read string $game_select_category
 * @property-read int $game_select_priority
 * @property-read bool $is_skill_tree_queue
 * @property-read bool $is_limited_time_queue
 * @property-read bool $is_bot_honoring_allowed
 * @property-read bool $hide_player_position
 * @property-read array $viable_champion_roster
 * @property-read string $pick_mode
 */
class QueueData extends StaticData {}
