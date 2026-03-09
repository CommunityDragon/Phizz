<?php

namespace Phizz\Apis\Lol\ChallengesV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $banner_accent
 * @property-read string $title
 * @property-read string $crest_border
 * @property-read int $prestige_crest_border_level
 * @property-read Collection<int, int> $challengeIds
 */
class PlayerClientPreferencesData extends Data
{
    protected array $collections = [
        'challenge_ids',
    ];
}
