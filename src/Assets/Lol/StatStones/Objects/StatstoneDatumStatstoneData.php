<?php

namespace Phizz\Assets\Lol\StatStones\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $content_id
 * @property-read int $item_id
 * @property-read bool $is_retired
 * @property-read int $tracking_type
 * @property-read bool $is_epic
 * @property-read string $description
 * @property-read array $milestones
 * @property-read StatstoneDatumStatstoneBoundChampionData $boundChampion
 * @property-read string $category
 * @property-read string $icon_unowned
 * @property-read string $icon_unlit
 * @property-read string $icon_lit
 * @property-read string $icon_full
 */
class StatstoneDatumStatstoneData extends StaticData
{
    protected array $objects = [
        'bound_champion' => StatstoneDatumStatstoneBoundChampionData::class,
    ];
}
