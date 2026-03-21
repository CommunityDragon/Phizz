# Phizz — Laravel client for the Riot Games API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/communitydragon/phizz.svg?style=flat-square)](https://packagist.org/packages/communitydragon/phizz)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/communitydragon/phizz/run-tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/communitydragon/phizz/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/communitydragon/phizz/fix-php-code-style-issues.yml?branch=master&label=code%20style&style=flat-square)](https://github.com/communitydragon/phizz/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/communitydragon/phizz.svg?style=flat-square)](https://packagist.org/packages/communitydragon/phizz)

A type-safe, auto-generated Laravel client for the Riot Games API. Covers League of Legends, Teamfight Tactics, Legends of Runeterra, Valorant, and Riftbound — generated directly from official OpenAPI schemas with built-in caching, proactive rate limiting, and automatic regional routing.

## Requirements

- PHP `>= 8.1`
- Laravel `>= 10`

## Installation

```bash
composer require communitydragon/phizz
```

Publish the config file:

```bash
php artisan vendor:publish --tag="phizz-config"
```

Add your Riot API key to `.env`:

```env
RIOT_API_KEY=your-api-key-here
RIOT_DEFAULT_PLATFORM=na1
```

## Usage

Access APIs through the `Phizz` facade. Each game exposes its own client.

```php
use Phizz\Facades\Phizz;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;

// League of Legends
$match    = Phizz::lol()->matchV5->getMatch('EUW1_1234567890');
$summoner = Phizz::lol()->summonerV4->getByPuuid($puuid);
$mastery  = Phizz::lol()->championMasteryV4->getAllChampionMasteriesByPuuid($puuid);

// Per-call platform override
$match = Phizz::lol(Platform::EUW)->matchV5->getMatch('EUW1_1234567890');

// Teamfight Tactics
$tftMatch    = Phizz::tft()->matchV1->getMatch('EUW1_1234567890');
$tftLeague   = Phizz::tft()->leagueV1->getChallengerLeague();
$tftSummoner = Phizz::tft()->summonerV1->getByPuuid($puuid);

// Valorant
$valMatch       = Phizz::val()->matchV1->getMatch($matchId);
$valLeaderboard = Phizz::val()->rankedV1->getLeaderboard('e7a1');

// Legends of Runeterra
$lorMatch       = Phizz::lor()->matchV1->getMatch($matchId);
$lorLeaderboard = Phizz::lor()->rankedV1->getLeaderboards();

// Account (cross-game)
$account = Phizz::riot()->accountV1->getByRiotId(gameName: 'IAmTheWhite', tagLine: 'EUW');
```

### Bypassing the cache

Every API method accepts a `force` parameter. When `true`, the request always hits the network and the cache is skipped entirely — nothing is read from it and nothing is written to it.

```php
// Always fetches fresh data, even when caching is enabled
$match = Phizz::lol()->matchV5->getMatch('EUW1_1234567890', force: true);
```

## Caching

Caching is enabled by default and uses your application's default cache store. The TTL applied to each response is resolved in this order:

1. Per-method override in `config/phizz.php` under `cache.method[]`
2. Global default (`cache.default`, 60 seconds)

Per-method TTLs are configured using the `TTL` class, which provides a chained constant syntax:

```php
use Phizz\TTL;

// config/phizz.php
'cache' => [
    'enabled' => env('RIOT_CACHE_ENABLED', true),
    'store'   => env('RIOT_CACHE_STORE', null),
    'default' => env('RIOT_CACHE_TTL', 60),
    'method'  => [
        TTL::lol::matchV5::getMatch           => 86400, // matches — cache for 24 h
        TTL::lol::matchV5::getTimeline        => 86400,
        TTL::lol::summonerV4::getByPuuid      => 3600,  // slow-changing — 1 h
        TTL::lol::leagueV4::getChallengerLeague => 300, // rankings — 5 min
        TTL::lol::spectatorV5::getCurrentGameInfoByPuuid => 30, // live game — 30 s
    ],
],
```

Sane defaults for all endpoints across every game are shipped in the published config.

## Retry strategy

Phizz automatically retries on `429` responses. Two built-in strategies are available:

```php
use Phizz\Retry;

// Exponential backoff: 1 s, 2 s, 4 s, 8 s, ...  (default)
'retry' => ['strategy' => Retry::exponential()],

// Fixed delay between every attempt
'retry' => ['strategy' => Retry::fixed(seconds: 2)],
```

When a `Retry-After` header is present in the 429 response, Phizz always respects it over the configured strategy.

## Rate limiting

Phizz tracks Riot's `X-App-Rate-Limit` and `X-Method-Rate-Limit` response headers and sleeps proactively before sending requests that would otherwise trigger a 429. Rate limit state is stored in the configured cache store and scoped per platform and endpoint.

## Platforms & regions

```php
use Phizz\Enums\Platform;    // na1, euw1, kr, br1, jp1, ...
use Phizz\Enums\Regional;    // Americas, Europe, Asia, SEA
use Phizz\Enums\ValPlatform; // NA, EU, AP, KR, BR, LatAm, Esports
```

Endpoints that require a regional host (e.g. match history) automatically convert a `Platform` to the correct `Regional` value — `Platform::EUW` becomes `Regional::Europe` transparently.

## Supported APIs

### Cross-game (`riot`)
| API | Version |
|-----|---------|
| Account | V1 |

### League of Legends (`lol`)
| API | Version |
|-----|---------|
| Challenges | V1 |
| Champion Mastery | V4 |
| Champion | V3 |
| Clash | V1 |
| League EXP | V4 |
| League | V4 |
| Match | V5 |
| RSO Match | V1 |
| Spectator | V5 |
| Status | V4 |
| Summoner | V4 |
| Tournament Stub | V5 |
| Tournament | V5 |

### Teamfight Tactics (`tft`)
| API | Version |
|-----|---------|
| League | V1 |
| Match | V1 |
| Spectator | V5 |
| Status | V1 |
| Summoner | V1 |

### Valorant (`val`)
| API | Version |
|-----|---------|
| Console Match | V1 |
| Console Ranked | V1 |
| Content | V1 |
| Match | V1 |
| Ranked | V1 |
| Status | V1 |

### Legends of Runeterra (`lor`)
| API | Version |
|-----|---------|
| Deck | V1 |
| Inventory | V1 |
| Match | V1 |
| Ranked | V1 |
| Status | V1 |

### Riftbound (`riftbound`)
| API | Version |
|-----|---------|
| Content | V1 |

## Configuration reference

```php
// config/phizz.php
return [
    // Your Riot Games API key
    'api_key' => env('RIOT_API_KEY', ''),

    // Default platform used when none is specified per-call
    'default_platform' => env('RIOT_DEFAULT_PLATFORM', Platform::NA),

    // Maximum seconds to wait for a response before timing out
    'timeout' => env('RIOT_TIMEOUT', 60),

    // Retry strategy on 429 responses
    'retry' => [
        'strategy' => Retry::exponential(),
    ],

    // Response caching
    'cache' => [
        'enabled' => env('RIOT_CACHE_ENABLED', true),
        'store'   => env('RIOT_CACHE_STORE', null),   // null = app default
        'default' => env('RIOT_CACHE_TTL', 60),       // fallback TTL in seconds
        'method'  => [
            // Per-endpoint TTL overrides using TTL constants
            TTL::lol::matchV5::getMatch => 86400,
            // ...
        ],
    ],

    // Log all requests and responses (useful for debugging)
    'logging' => [
        'enabled' => env('RIOT_LOGGING_ENABLED', false),
    ],
];
```

## Testing

```bash
composer test           # run the full test suite
composer test-coverage  # run tests with coverage report
composer analyse        # run PHPStan static analysis
composer format         # run Laravel Pint code formatter
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sandi Karajic](https://github.com/skarajic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
