<?php

namespace Phizz\CDragon\EventHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read EventQuestSkinLineDataEntryValueBaseSkinInfoData $baseSkinInfo
 * @property-read Collection<int, EventQuestSkinLineDataEntryValueQuestSkinsInfoData> $questSkinsInfo
 */
class EventQuestSkinLineDataEntryValueData extends StaticData
{
    protected array $objects = [
        'base_skin_info' => EventQuestSkinLineDataEntryValueBaseSkinInfoData::class,
    ];

    protected array $collections = [
        'quest_skins_info' => EventQuestSkinLineDataEntryValueQuestSkinsInfoData::class,
    ];
}
