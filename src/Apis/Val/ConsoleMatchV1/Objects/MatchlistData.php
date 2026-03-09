<?php

namespace Phizz\Apis\Val\ConsoleMatchV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read Collection<int, MatchlistEntryData> $history
 */
class MatchlistData extends Data
{
    protected array $collections = [
        'history' => MatchlistEntryData::class,
    ];
}
