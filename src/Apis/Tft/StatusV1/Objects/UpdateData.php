<?php

namespace Phizz\Apis\Tft\StatusV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $id
 * @property-read string $author
 * @property-read bool $publish
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read Collection<int, string> $publishLocations (Legal values: riotclient, riotstatus, game)
 * @property-read Collection<int, ContentData> $translations
 */
class UpdateData extends Data
{
    protected array $collections = [
        'publish_locations',
        'translations' => ContentData::class,
    ];
}
