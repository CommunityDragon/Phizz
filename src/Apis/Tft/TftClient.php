<?php

namespace Phizz\Apis\Tft;

use Phizz\Apis\Tft\LeagueV1\LeagueV1Api;
use Phizz\Apis\Tft\MatchV1\MatchV1Api;
use Phizz\Apis\Tft\SpectatorV5\SpectatorV5Api;
use Phizz\Apis\Tft\StatusV1\StatusV1Api;
use Phizz\Apis\Tft\SummonerV1\SummonerV1Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property SpectatorV5Api $spectatorV5
 * @property LeagueV1Api $leagueV1
 * @property MatchV1Api $matchV1
 * @property StatusV1Api $statusV1
 * @property SummonerV1Api $summonerV1
 *
 * @method SpectatorV5Api spectatorV5(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method LeagueV1Api leagueV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method MatchV1Api matchV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method StatusV1Api statusV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method SummonerV1Api summonerV1(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class TftClient extends Constructable
{
    protected array $constructable = [
        'spectatorV5' => SpectatorV5Api::class,
        'leagueV1' => LeagueV1Api::class,
        'matchV1' => MatchV1Api::class,
        'statusV1' => StatusV1Api::class,
        'summonerV1' => SummonerV1Api::class,
    ];
}
