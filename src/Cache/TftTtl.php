<?php

namespace Phizz\Cache;

use Phizz\Cache\Tft\LeagueV1Ttl;
use Phizz\Cache\Tft\MatchV1Ttl;
use Phizz\Cache\Tft\SpectatorV5Ttl;
use Phizz\Cache\Tft\StatusV1Ttl;
use Phizz\Cache\Tft\SummonerV1Ttl;

/**
 * @internal
 *
 * @property-read class-string<SpectatorV5Ttl> $spectatorV5
 * @property-read class-string<LeagueV1Ttl> $leagueV1
 * @property-read class-string<MatchV1Ttl> $matchV1
 * @property-read class-string<StatusV1Ttl> $statusV1
 * @property-read class-string<SummonerV1Ttl> $summonerV1
 */
final class TftTtl
{
    public const spectatorV5 = SpectatorV5Ttl::class;

    public const leagueV1 = LeagueV1Ttl::class;

    public const matchV1 = MatchV1Ttl::class;

    public const statusV1 = StatusV1Ttl::class;

    public const summonerV1 = SummonerV1Ttl::class;

    private function __construct() {}
}
