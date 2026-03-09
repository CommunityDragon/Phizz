<?php

namespace Phizz\Apis\Val\ConsoleMatchV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid
 * @property-read string $game_name
 * @property-read string $tag_line
 * @property-read string $team_id
 * @property-read string $party_id
 * @property-read string $character_id
 * @property-read int $competitive_tier
 * @property-read string $player_card
 * @property-read string $player_title
 * @property-read PlayerStatsData $stats
 */
class PlayerData extends Data
{
    protected array $objects = [
        'stats' => PlayerStatsData::class,
    ];
}
