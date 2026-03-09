<?php

namespace Phizz\Apis\Lol\SpectatorV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $pick_turn The turn during which the champion was banned
 * @property-read int $champion_id The ID of the banned champion
 * @property-read int $team_id The ID of the team that banned the champion
 */
class BannedChampionData extends Data {}
