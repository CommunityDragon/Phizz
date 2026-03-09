<?php

namespace Phizz\Apis\Lol\ClashV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read string $team_id
 * @property-read string $position (Legal values:  UNSELECTED,  FILL,  TOP,  JUNGLE,  MIDDLE,  BOTTOM,  UTILITY)
 * @property-read string $role (Legal values:  CAPTAIN,  MEMBER)
 */
class PlayerData extends Data {}
