<?php

namespace Phizz\Apis\Lol\TournamentV5;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\TournamentV5\Objects\LobbyEventV5DtoWrapperData;
use Phizz\Apis\Lol\TournamentV5\Objects\TournamentCodeV5Data;
use Phizz\Apis\Lol\TournamentV5\Objects\TournamentGamesV5Data;
use Phizz\Cache\Lol\TournamentV5Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class TournamentV5Api extends Api
{
    /**
     * @returns Collection<int, string>
     */
    public function createTournamentCode(
        ?int $count,
        int $tournamentId,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament/v5/codes',
            cacheKey: TournamentV5Ttl::createTournamentCode,
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            query: [
                'count' => $count,
                'tournamentId' => $tournamentId,
            ],
            force: $force,
        );
    }

    /**
     * @returns TournamentCodeV5Data
     */
    public function getTournamentCode(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): TournamentCodeV5Data {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/tournament/v5/codes/{tournamentCode}',
            cacheKey: TournamentV5Ttl::getTournamentCode,
            returns: true,
            platformType: Regional::class,
            returnType: TournamentCodeV5Data::class,
            platform: $platform,
            pathParams: [
                'tournamentCode' => $tournamentCode,
            ],
            force: $force,
        );
    }

    /**
     * @returns void
     */
    public function updateCode(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): void {
        $this->fetch(
            method: 'PUT',
            endpoint: '/lol/tournament/v5/codes/{tournamentCode}',
            cacheKey: TournamentV5Ttl::updateCode,
            returns: false,
            platformType: Regional::class,
            platform: $platform,
            pathParams: [
                'tournamentCode' => $tournamentCode,
            ],
            force: $force,
        );
    }

    /**
     * @returns Collection<int, TournamentGamesV5Data>
     */
    public function getGames(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): Collection {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/tournament/v5/games/by-code/{tournamentCode}',
            cacheKey: TournamentV5Ttl::getGames,
            returns: true,
            platformType: Regional::class,
            collectionType: TournamentGamesV5Data::class,
            platform: $platform,
            pathParams: [
                'tournamentCode' => $tournamentCode,
            ],
            force: $force,
        );
    }

    /**
     * @returns LobbyEventV5DtoWrapperData
     */
    public function getLobbyEventsByCode(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
        bool $force = false,
    ): LobbyEventV5DtoWrapperData {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lol/tournament/v5/lobby-events/by-code/{tournamentCode}',
            cacheKey: TournamentV5Ttl::getLobbyEventsByCode,
            returns: true,
            platformType: Regional::class,
            returnType: LobbyEventV5DtoWrapperData::class,
            platform: $platform,
            pathParams: [
                'tournamentCode' => $tournamentCode,
            ],
            force: $force,
        );
    }

    /**
     * @returns int
     */
    public function registerProviderData(Regional|Platform|string|null $platform = null, bool $force = false): int
    {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament/v5/providers',
            cacheKey: TournamentV5Ttl::registerProviderData,
            returns: true,
            platformType: Regional::class,
            platform: $platform,
            force: $force,
        );
    }

    /**
     * @returns int
     */
    public function registerTournament(Regional|Platform|string|null $platform = null, bool $force = false): int
    {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament/v5/tournaments',
            cacheKey: TournamentV5Ttl::registerTournament,
            returns: true,
            platformType: Regional::class,
            platform: $platform,
            force: $force,
        );
    }
}
