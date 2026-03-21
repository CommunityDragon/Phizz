<?php

namespace Phizz\Apis\Lol\ClashV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\ClashV1\Objects\PlayerData;
use Phizz\Apis\Lol\ClashV1\Objects\TeamData;
use Phizz\Apis\Lol\ClashV1\Objects\TournamentData;
use Phizz\Cache\Lol\ClashV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Support\Api;

class ClashV1Api extends Api
{
    /**
     * @returns Collection<int, PlayerData>
     */
    public function getPlayersByPuuid(string $puuid, Platform|string|null $platform = null, bool $force = false): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/players/by-puuid/{puuid}',
            cacheKey: ClashV1Ttl::getPlayersByPuuid,
            returns: true,
            platformType: Platform::class,
            collectionType: PlayerData::class,
            platform: $platform,
            pathParams: [
                'puuid' => $puuid,
            ],
            force: $force,
        );
    }

    /**
     * @returns TeamData
     */
    public function getTeamById(string $teamId, Platform|string|null $platform = null, bool $force = false): TeamData
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/teams/{teamId}',
            cacheKey: ClashV1Ttl::getTeamById,
            returns: true,
            platformType: Platform::class,
            returnType: TeamData::class,
            platform: $platform,
            pathParams: [
                'teamId' => $teamId,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, TournamentData>
     */
    public function getTournaments(Platform|string|null $platform = null, bool $force = false): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/tournaments',
            cacheKey: ClashV1Ttl::getTournaments,
            returns: true,
            platformType: Platform::class,
            collectionType: TournamentData::class,
            platform: $platform,
            force: $force,
        );
    }

    /**
     * @returns TournamentData
     */
    public function getTournamentByTeam(
        string $teamId,
        Platform|string|null $platform = null,
        bool $force = false,
    ): TournamentData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/tournaments/by-team/{teamId}',
            cacheKey: ClashV1Ttl::getTournamentByTeam,
            returns: true,
            platformType: Platform::class,
            returnType: TournamentData::class,
            platform: $platform,
            pathParams: [
                'teamId' => $teamId,
            ],
            force: $force,
        );
    }

    /**
     * @returns TournamentData
     */
    public function getTournamentById(
        int $tournamentId,
        Platform|string|null $platform = null,
        bool $force = false,
    ): TournamentData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/clash/v1/tournaments/{tournamentId}',
            cacheKey: ClashV1Ttl::getTournamentById,
            returns: true,
            platformType: Platform::class,
            returnType: TournamentData::class,
            platform: $platform,
            pathParams: [
                'tournamentId' => $tournamentId,
            ],
            force: $force,
        );
    }
}
