<?php

namespace Phizz\Apis\Lol\ClashV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ClashV1\Objects\PlayerData;
use Phizz\Apis\Lol\ClashV1\Objects\TeamData;
use Phizz\Apis\Lol\ClashV1\Objects\TournamentData;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ClashV1Api extends Api
{
    /**
     * @returns Collection<int, PlayerData>
     */
    public function getPlayersByPuuid(string $puuid, Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/clash/v1/players/by-puuid/$puuid",
            returns: true,
            platformType: Platform::class,
            collectionType: PlayerData::class,
            platform: $platform,
        );
    }

    /**
     * @returns TeamData
     */
    public function getTeamById(string $teamId, Platform|string|null $platform = null): TeamData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/clash/v1/teams/$teamId",
            returns: true,
            platformType: Platform::class,
            returnType: TeamData::class,
            platform: $platform,
        );
    }

    /**
     * @returns Collection<int, TournamentData>
     */
    public function getTournaments(Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/tournaments',
            returns: true,
            platformType: Platform::class,
            collectionType: TournamentData::class,
            platform: $platform,
        );
    }

    /**
     * @returns TournamentData
     */
    public function getTournamentByTeam(string $teamId, Platform|string|null $platform = null): TournamentData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/clash/v1/tournaments/by-team/$teamId",
            returns: true,
            platformType: Platform::class,
            returnType: TournamentData::class,
            platform: $platform,
        );
    }

    /**
     * @returns TournamentData
     */
    public function getTournamentById(int $tournamentId, Platform|string|null $platform = null): TournamentData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/clash/v1/tournaments/$tournamentId",
            returns: true,
            platformType: Platform::class,
            returnType: TournamentData::class,
            platform: $platform,
        );
    }
}
