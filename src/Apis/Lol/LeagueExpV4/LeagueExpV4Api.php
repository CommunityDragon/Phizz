<?php

namespace Phizz\Apis\Lol\LeagueExpV4;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\LeagueExpV4\Objects\LeagueEntryData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class LeagueExpV4Api extends Api
{
    /**
     * @returns Collection<int, LeagueEntryData>
     */
    public function getLeagueEntries(
        string $queue,
        string $tier,
        string $division,
        ?int $page = null,
        Platform|string|null $platform = null,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/league-exp/v4/entries/$queue/$tier/$division",
            returns: true,
            platformType: Platform::class,
            collectionType: LeagueEntryData::class,
            platform: $platform,
            query: [
                'page' => $page,
            ],
        );
    }
}
