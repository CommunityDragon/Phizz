<?php

namespace Phizz\Apis\Lol\ClashV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $id
 * @property-read int $theme_id
 * @property-read string $name_key
 * @property-read string $name_key_secondary
 * @property-read Collection<int, TournamentPhaseData> $schedule Tournament phase.
 */
class TournamentData extends Data
{
    protected array $collections = [
        'schedule' => TournamentPhaseData::class,
    ];
}
