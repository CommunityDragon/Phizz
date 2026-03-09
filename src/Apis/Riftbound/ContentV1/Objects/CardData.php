<?php

namespace Phizz\Apis\Riftbound\ContentV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read string $id Card ID
 * @property-read int $collector_number
 * @property-read string $set
 * @property-read string $name Card Name
 * @property-read string $description
 * @property-read string $type Card Type
 * @property-read string $rarity
 * @property-read string $faction
 * @property-read string $flavor_text
 * @property-read Collection<int, string> $keywords
 * @property-read Collection<int, string> $tags
 * @property-read CardStatsData $stats
 * @property-read CardArtData $art
 */
class CardData extends Data
{
    protected array $collections = [
        'keywords',
    ];

    protected array $objects = [
        'stats' => CardStatsData::class,
        'art' => CardArtData::class,
    ];
}
