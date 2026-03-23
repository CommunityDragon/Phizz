<?php

namespace Phizz\Assets\Lol\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $localized_narrative_title
 * @property-read string $localized_narrative_description
 * @property-read string $narrative_background_image
 * @property-read int $narrative_starting_track_level
 * @property-read EventNarrativeElementNarrativeVideoData $narrativeVideo
 */
class EventNarrativeElementData extends StaticData
{
    protected array $objects = [
        'narrative_video' => EventNarrativeElementNarrativeVideoData::class,
    ];
}
