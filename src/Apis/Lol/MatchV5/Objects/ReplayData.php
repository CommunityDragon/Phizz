<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $total Total of replay files
 * @property-read Collection<int, string> $matchFileUrLs
 */
class ReplayData extends Data
{
    protected array $collections = [
        'match_file_ur_ls',
    ];
}
