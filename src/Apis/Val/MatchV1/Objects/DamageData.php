<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $receiver PUUID
 * @property-read int $damage
 * @property-read int $legshots
 * @property-read int $bodyshots
 * @property-read int $headshots
 */
class DamageData extends Data {}
