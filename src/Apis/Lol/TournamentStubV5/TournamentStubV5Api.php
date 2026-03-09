<?php

namespace Phizz\Apis\Lol\TournamentStubV5;

use Illuminate\Support\Collection;
use Phizz\Apis\Lol\TournamentStubV5\Objects\LobbyEventV5DtoWrapperData;
use Phizz\Apis\Lol\TournamentStubV5\Objects\TournamentCodeV5Data;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class TournamentStubV5Api extends Api
{
    /**
     * @returns Collection<int, string>
     */
    public function createTournamentCode(
        ?int $count,
        int $tournamentId,
        Regional|Platform|string|null $platform = null,
    ): Collection {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament-stub/v5/codes',
            returns: true,
            platformType: Regional::class,
            returnType: Collection::class,
            platform: $platform,
            query: [
                'count' => $count,
                'tournamentId' => $tournamentId,
            ],
        );
    }

    /**
     * @returns TournamentCodeV5Data
     */
    public function getTournamentCode(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
    ): TournamentCodeV5Data {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/tournament-stub/v5/codes/$tournamentCode",
            returns: true,
            platformType: Regional::class,
            returnType: TournamentCodeV5Data::class,
            platform: $platform,
        );
    }

    /**
     * @returns LobbyEventV5DtoWrapperData
     */
    public function getLobbyEventsByCode(
        string $tournamentCode,
        Regional|Platform|string|null $platform = null,
    ): LobbyEventV5DtoWrapperData {
        return $this->fetch(
            method: 'GET',
            endpoint: "/lol/tournament-stub/v5/lobby-events/by-code/$tournamentCode",
            returns: true,
            platformType: Regional::class,
            returnType: LobbyEventV5DtoWrapperData::class,
            platform: $platform,
        );
    }

    /**
     * @returns int
     */
    public function registerProviderData(Regional|Platform|string|null $platform = null): int
    {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament-stub/v5/providers',
            returns: true,
            platformType: Regional::class,
            platform: $platform,
        );
    }

    /**
     * @returns int
     */
    public function registerTournament(Regional|Platform|string|null $platform = null): int
    {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lol/tournament-stub/v5/tournaments',
            returns: true,
            platformType: Regional::class,
            platform: $platform,
        );
    }
}
