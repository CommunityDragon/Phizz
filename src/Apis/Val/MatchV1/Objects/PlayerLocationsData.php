<?php

namespace Phizz\Apis\Val\MatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read float $view_radians
 * @property-read LocationData $location
 */
class PlayerLocationsData extends Data
{
    protected array $objects = [
        'location' => LocationData::class,
    ];
}
