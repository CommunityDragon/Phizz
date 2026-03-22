<?php

namespace Phizz\CDragon\Statstones\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, StatstoneDatumData> $statstoneData
 * @property-read Collection<int, PackDatumData> $packData
 * @property-read array $pack_id_to_stat_stones_ids
 * @property-read array $series_id_to_stat_stone_ids
 * @property-read array $pack_id_to_sub_pack_ids
 * @property-read array $collection_id_to_stat_stone_ids
 * @property-read array $pack_id_to_champ_ids
 * @property-read array $champ_id_to_pack_ids
 * @property-read array $pack_item_id_to_containing_pack_item_id
 */
class StatstoneData extends StaticData
{
    protected array $collections = [
        'statstone_data' => StatstoneDatumData::class,
        'pack_data' => PackDatumData::class,
    ];
}
