<?php

namespace Phizz\CDragon\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read float $o
 * @property-read EventQuestSkinLineDataEntryValueData $value
 */
class EventQuestSkinLineDataEntryData extends StaticData
{
    protected array $objects = [
        'value' => EventQuestSkinLineDataEntryValueData::class,
    ];
}
