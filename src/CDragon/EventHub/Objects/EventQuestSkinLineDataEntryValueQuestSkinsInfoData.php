<?php

namespace Phizz\CDragon\EventHub\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read EventQuestSkinLineDataEntryValueQuestSkinsInfoSkinInfoData $skinInfo
 */
class EventQuestSkinLineDataEntryValueQuestSkinsInfoData extends StaticData
{
    protected array $objects = [
        'skin_info' => EventQuestSkinLineDataEntryValueQuestSkinsInfoSkinInfoData::class,
    ];
}
