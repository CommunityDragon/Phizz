<?php

namespace Phizz\CDragon\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read EventData $event
 */
class EventHubData extends StaticData
{
    protected array $objects = [
        'event' => EventData::class,
    ];
}
