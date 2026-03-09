<?php

namespace Phizz\Apis\Lor\StatusV1\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $id
 * @property-read string $maintenance_status (Legal values:  scheduled,  in_progress,  complete)
 * @property-read string $incident_severity (Legal values:  info,  warning,  critical)
 * @property-read string $created_at
 * @property-read string $archive_at
 * @property-read string $updated_at
 * @property-read Collection<int, ContentData> $titles
 * @property-read Collection<int, UpdateData> $updates
 * @property-read Collection<int, string> $platforms (Legal values: windows, macos, android, ios, ps4, xbone, switch)
 */
class StatusData extends Data
{
    protected array $collections = [
        'titles' => ContentData::class,
        'updates' => UpdateData::class,
        'platforms',
    ];
}
