<?php

namespace Phizz\Apis\Tft\LeagueV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid Player Universal Unique Identifier. Exact length of 78 characters. (Encrypted)
 * @property-read string $league_id Not included for the RANKED_TFT_TURBO queueType.
 * @property-read string $queue_type
 * @property-read string $rated_tier Only included for the RANKED_TFT_TURBO queueType.
 *              (Legal values:  ORANGE,  PURPLE,  BLUE,  GREEN,  GRAY)
 * @property-read int $rated_rating Only included for the RANKED_TFT_TURBO queueType.
 * @property-read string $tier Not included for the RANKED_TFT_TURBO queueType.
 * @property-read string $rank The player's division within a tier. Not included for the RANKED_TFT_TURBO queueType.
 * @property-read int $league_points Not included for the RANKED_TFT_TURBO queueType.
 * @property-read int $wins First placement.
 * @property-read int $losses Second through eighth placement.
 * @property-read bool $hot_streak Not included for the RANKED_TFT_TURBO queueType.
 * @property-read bool $veteran Not included for the RANKED_TFT_TURBO queueType.
 * @property-read bool $fresh_blood Not included for the RANKED_TFT_TURBO queueType.
 * @property-read bool $inactive Not included for the RANKED_TFT_TURBO queueType.
 * @property-read MiniSeriesData $miniSeries
 */
class LeagueEntryData extends Data
{
    protected array $objects = [
        'mini_series' => MiniSeriesData::class,
    ];
}
