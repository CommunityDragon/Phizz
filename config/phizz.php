<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Riot Games API Key
    |--------------------------------------------------------------------------
    |
    | Your Riot Games API key. You can obtain one from the Riot Developer Portal.
    | It is recommended to store this in your .env file as RIOT_API_KEY.
    |
    */

    'api_key' => env('RIOT_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Platform
    |--------------------------------------------------------------------------
    |
    | The platform region to use when making API calls. This can be overridden
    | on a per‑call basis.
    |
    */

    'default_platform' => env('RIOT_DEFAULT_PLATFORM', \Phizz\Enums\Platform::NA),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout (seconds)
    |--------------------------------------------------------------------------
    |
    | The maximum number of seconds to wait for a response from the Riot API.
    |
    */

    'timeout' => env('RIOT_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | Retry Strategy
    |--------------------------------------------------------------------------
    |
    | The strategy used to calculate delays between retries on 429 responses.
    | Use Retry::exponential() for 1s, 2s, 4s, 8s... backoff, or
    | Retry::fixed(2) for a constant 2s delay between retries.
    |
    */

    'retry' => [
        'strategy' => \Phizz\Retry::exponential(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Enable or disable caching of API responses. The default TTL applies to
    | any endpoint not listed under method[]. Per-method TTLs are keyed by
    | the generated TTL constants, navigated via the TTL class:
    |   \Phizz\TTL::lol::matchV5::getMatch => 86400
    |
    */

    'cache' => [
        'enabled' => env('RIOT_CACHE_ENABLED', true),
        'store' => env('RIOT_CACHE_STORE', null),
        'default' => env('RIOT_CACHE_TTL', 60),
        'method' => [
            \Phizz\TTL::riot::accountV1::getByPuuid => 3600,
            \Phizz\TTL::riot::accountV1::getByRiotId => 3600,
            \Phizz\TTL::riot::accountV1::getByAccessToken => 300,
            \Phizz\TTL::riot::accountV1::getActiveShard => 3600,
            \Phizz\TTL::riot::accountV1::getActiveRegion => 3600,
            \Phizz\TTL::lol::challengesV1::getAllChallengeConfigs => 3600,
            \Phizz\TTL::lol::challengesV1::getAllChallengePercentiles => 3600,
            \Phizz\TTL::lol::challengesV1::getChallengeConfigs => 3600,
            \Phizz\TTL::lol::challengesV1::getChallengeLeaderboards => 300,
            \Phizz\TTL::lol::challengesV1::getChallengePercentiles => 3600,
            \Phizz\TTL::lol::challengesV1::getPlayerData => 300,
            \Phizz\TTL::lol::championMasteryV4::getAllChampionMasteriesByPuuid => 300,
            \Phizz\TTL::lol::championMasteryV4::getChampionMasteryByPuuid => 300,
            \Phizz\TTL::lol::championMasteryV4::getTopChampionMasteriesByPuuid => 300,
            \Phizz\TTL::lol::championMasteryV4::getChampionMasteryScoreByPuuid => 300,
            \Phizz\TTL::lol::championV3::getChampionInfo => 3600,
            \Phizz\TTL::lol::clashV1::getPlayersByPuuid => 300,
            \Phizz\TTL::lol::clashV1::getTeamById => 300,
            \Phizz\TTL::lol::clashV1::getTournaments => 600,
            \Phizz\TTL::lol::clashV1::getTournamentByTeam => 300,
            \Phizz\TTL::lol::clashV1::getTournamentById => 600,
            \Phizz\TTL::lol::leagueExpV4::getLeagueEntries => 300,
            \Phizz\TTL::lol::leagueV4::getChallengerLeague => 300,
            \Phizz\TTL::lol::leagueV4::getLeagueEntriesByPuuid => 300,
            \Phizz\TTL::lol::leagueV4::getLeagueEntries => 300,
            \Phizz\TTL::lol::leagueV4::getGrandmasterLeague => 300,
            \Phizz\TTL::lol::leagueV4::getLeagueById => 300,
            \Phizz\TTL::lol::leagueV4::getMasterLeague => 300,
            \Phizz\TTL::lol::matchV5::getMatchIdsByPuuid => 300,
            \Phizz\TTL::lol::matchV5::getReplay => 86400,
            \Phizz\TTL::lol::matchV5::getMatch => 86400,
            \Phizz\TTL::lol::matchV5::getTimeline => 86400,
            \Phizz\TTL::lol::rsoMatchV1::getMatchIds => 300,
            \Phizz\TTL::lol::rsoMatchV1::getMatch => 86400,
            \Phizz\TTL::lol::rsoMatchV1::getTimeline => 86400,
            \Phizz\TTL::lol::spectatorV5::getCurrentGameInfoByPuuid => 30,
            \Phizz\TTL::lol::summonerV4::getByPuuid => 3600,
            \Phizz\TTL::lol::summonerV4::getByAccessToken => 300,
            \Phizz\TTL::lol::tournamentV5::getTournamentCode => 3600,
            \Phizz\TTL::lol::tournamentV5::getGames => 600,
            \Phizz\TTL::lol::tournamentV5::getLobbyEventsByCode => 300,
            \Phizz\TTL::lol::tournamentStubV5::getTournamentCode => 3600,
            \Phizz\TTL::lol::tournamentStubV5::getLobbyEventsByCode => 300,
            \Phizz\TTL::lor::inventoryV1::getCards => 3600,
            \Phizz\TTL::lor::matchV1::getMatchIdsByPuuid => 300,
            \Phizz\TTL::lor::matchV1::getMatch => 86400,
            \Phizz\TTL::lor::rankedV1::getLeaderboards => 300,
            \Phizz\TTL::riftbound::contentV1::getContent => 3600,
            \Phizz\TTL::tft::leagueV1::getLeagueEntriesByPuuid => 300,
            \Phizz\TTL::tft::leagueV1::getChallengerLeague => 300,
            \Phizz\TTL::tft::leagueV1::getLeagueEntries => 300,
            \Phizz\TTL::tft::leagueV1::getGrandmasterLeague => 300,
            \Phizz\TTL::tft::leagueV1::getLeagueById => 300,
            \Phizz\TTL::tft::leagueV1::getMasterLeague => 300,
            \Phizz\TTL::tft::leagueV1::getTopRatedLadder => 300,
            \Phizz\TTL::tft::matchV1::getMatchIdsByPuuid => 300,
            \Phizz\TTL::tft::matchV1::getMatch => 86400,
            \Phizz\TTL::tft::spectatorV5::getCurrentGameInfoByPuuid => 30,
            \Phizz\TTL::tft::summonerV1::getByPuuid => 3600,
            \Phizz\TTL::tft::summonerV1::getByAccessToken => 300,
            \Phizz\TTL::val::consoleMatchV1::getMatch => 86400,
            \Phizz\TTL::val::consoleMatchV1::getMatchlist => 300,
            \Phizz\TTL::val::consoleMatchV1::getRecent => 300,
            \Phizz\TTL::val::consoleRankedV1::getLeaderboard => 300,
            \Phizz\TTL::val::contentV1::getContent => 3600,
            \Phizz\TTL::val::matchV1::getMatch => 86400,
            \Phizz\TTL::val::matchV1::getMatchlist => 300,
            \Phizz\TTL::val::matchV1::getRecent => 300,
            \Phizz\TTL::val::rankedV1::getLeaderboard => 300,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Log all API requests and responses? Useful for debugging.
    |
    */

    'logging' => [
        'enabled' => env('RIOT_LOGGING_ENABLED', false),
    ],

];
