<?php

namespace Phizz\Cache;

use Phizz\Cache\Lol\ChallengesV1Ttl;
use Phizz\Cache\Lol\ChampionMasteryV4Ttl;
use Phizz\Cache\Lol\ChampionV3Ttl;
use Phizz\Cache\Lol\ClashV1Ttl;
use Phizz\Cache\Lol\LeagueExpV4Ttl;
use Phizz\Cache\Lol\LeagueV4Ttl;
use Phizz\Cache\Lol\MatchV5Ttl;
use Phizz\Cache\Lol\RsoMatchV1Ttl;
use Phizz\Cache\Lol\SpectatorV5Ttl;
use Phizz\Cache\Lol\StatusV4Ttl;
use Phizz\Cache\Lol\SummonerV4Ttl;
use Phizz\Cache\Lol\TournamentStubV5Ttl;
use Phizz\Cache\Lol\TournamentV5Ttl;

/**
 * @internal
 *
 * @property-read class-string<ChampionMasteryV4Ttl> $championMasteryV4
 * @property-read class-string<ChampionV3Ttl> $championV3
 * @property-read class-string<ClashV1Ttl> $clashV1
 * @property-read class-string<LeagueExpV4Ttl> $leagueExpV4
 * @property-read class-string<LeagueV4Ttl> $leagueV4
 * @property-read class-string<ChallengesV1Ttl> $challengesV1
 * @property-read class-string<RsoMatchV1Ttl> $rsoMatchV1
 * @property-read class-string<StatusV4Ttl> $statusV4
 * @property-read class-string<MatchV5Ttl> $matchV5
 * @property-read class-string<SpectatorV5Ttl> $spectatorV5
 * @property-read class-string<SummonerV4Ttl> $summonerV4
 * @property-read class-string<TournamentStubV5Ttl> $tournamentStubV5
 * @property-read class-string<TournamentV5Ttl> $tournamentV5
 */
final class LolTtl
{
    public const championMasteryV4 = ChampionMasteryV4Ttl::class;

    public const championV3 = ChampionV3Ttl::class;

    public const clashV1 = ClashV1Ttl::class;

    public const leagueExpV4 = LeagueExpV4Ttl::class;

    public const leagueV4 = LeagueV4Ttl::class;

    public const challengesV1 = ChallengesV1Ttl::class;

    public const rsoMatchV1 = RsoMatchV1Ttl::class;

    public const statusV4 = StatusV4Ttl::class;

    public const matchV5 = MatchV5Ttl::class;

    public const spectatorV5 = SpectatorV5Ttl::class;

    public const summonerV4 = SummonerV4Ttl::class;

    public const tournamentStubV5 = TournamentStubV5Ttl::class;

    public const tournamentV5 = TournamentV5Ttl::class;

    private function __construct() {}
}
