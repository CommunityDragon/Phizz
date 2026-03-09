<?php

namespace Phizz\Apis\Lol;

use Phizz\Apis\Lol\ChallengesV1\ChallengesV1Api;
use Phizz\Apis\Lol\ChampionMasteryV4\ChampionMasteryV4Api;
use Phizz\Apis\Lol\ChampionV3\ChampionV3Api;
use Phizz\Apis\Lol\ClashV1\ClashV1Api;
use Phizz\Apis\Lol\LeagueExpV4\LeagueExpV4Api;
use Phizz\Apis\Lol\LeagueV4\LeagueV4Api;
use Phizz\Apis\Lol\MatchV5\MatchV5Api;
use Phizz\Apis\Lol\RsoMatchV1\RsoMatchV1Api;
use Phizz\Apis\Lol\SpectatorV5\SpectatorV5Api;
use Phizz\Apis\Lol\StatusV4\StatusV4Api;
use Phizz\Apis\Lol\SummonerV4\SummonerV4Api;
use Phizz\Apis\Lol\TournamentStubV5\TournamentStubV5Api;
use Phizz\Apis\Lol\TournamentV5\TournamentV5Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property ChampionMasteryV4Api $championMasteryV4
 * @property ChampionV3Api $championV3
 * @property ClashV1Api $clashV1
 * @property LeagueExpV4Api $leagueExpV4
 * @property LeagueV4Api $leagueV4
 * @property ChallengesV1Api $challengesV1
 * @property RsoMatchV1Api $rsoMatchV1
 * @property StatusV4Api $statusV4
 * @property MatchV5Api $matchV5
 * @property SpectatorV5Api $spectatorV5
 * @property SummonerV4Api $summonerV4
 * @property TournamentStubV5Api $tournamentStubV5
 * @property TournamentV5Api $tournamentV5
 *
 * @method ChampionMasteryV4Api championMasteryV4(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ChampionV3Api championV3(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ClashV1Api clashV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method LeagueExpV4Api leagueExpV4(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method LeagueV4Api leagueV4(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ChallengesV1Api challengesV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method RsoMatchV1Api rsoMatchV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method StatusV4Api statusV4(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method MatchV5Api matchV5(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method SpectatorV5Api spectatorV5(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method SummonerV4Api summonerV4(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method TournamentStubV5Api tournamentStubV5(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method TournamentV5Api tournamentV5(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class LolClient extends Constructable
{
    protected array $constructable = [
        'championMasteryV4' => ChampionMasteryV4Api::class,
        'championV3' => ChampionV3Api::class,
        'clashV1' => ClashV1Api::class,
        'leagueExpV4' => LeagueExpV4Api::class,
        'leagueV4' => LeagueV4Api::class,
        'challengesV1' => ChallengesV1Api::class,
        'rsoMatchV1' => RsoMatchV1Api::class,
        'statusV4' => StatusV4Api::class,
        'matchV5' => MatchV5Api::class,
        'spectatorV5' => SpectatorV5Api::class,
        'summonerV4' => SummonerV4Api::class,
        'tournamentStubV5' => TournamentStubV5Api::class,
        'tournamentV5' => TournamentV5Api::class,
    ];
}
