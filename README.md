# Phizz - An auto-generated Laravel library for Riot API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/communitydragon/phizz.svg?style=flat-square)](https://packagist.org/packages/communitydragon/phizz)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/communitydragon/phizz/run-tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/communitydragon/phizz/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/communitydragon/phizz/fix-php-code-style-issues.yml?branch=master&label=code%20style&style=flat-square)](https://github.com/communitydragon/phizz/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/communitydragon/phizz.svg?style=flat-square)](https://packagist.org/packages/communitydragon/phizz)

A type-safe, auto-generated Laravel client for the Riot Games API. It provides fluent access to League of Legends, Teamfight Tactics, Legends of Runeterra, Valorant, and Riftbound APIs — all generated from official OpenAPI schemas.

## Requirements

- PHP `^8.1`
- Laravel `^10`

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

## Configuration

```php
// config/phizz.php
return [
    'api_key'          => env('RIOT_API_KEY', ''),
    'default_platform' => env('RIOT_DEFAULT_PLATFORM', Platform::NA),
    'timeout'          => env('RIOT_TIMEOUT', 60), // seconds
    'cache' => [
        'enabled' => env('RIOT_CACHE_ENABLED', true),
        'default' => env('RIOT_CACHE_TTL', 60), // seconds
        'method'  => [],
    ],
    'logging' => [
        'enabled' => env('RIOT_LOGGING_ENABLED', false),
    ],
];
```

## Usage

Access APIs through the `Phizz` facade or the bound instance. Each game has its own client (`lol`, `tft`, `lor`, `val`, `riot`, `riftbound`).

```php
use Phizz\Facades\Phizz;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;

// League of Legends
$match     = Phizz::lol()->matchV5->getMatch('EUW1_1234567890');
$summoner  = Phizz::lol()->summonerV4->getByPuuid($puuid);
$mastery   = Phizz::lol()->championMasteryV4->getAllChampionMasteriesByPuuid($puuid);

// Override platform per call
$match = Phizz::lol(Platform::EUW)->matchV5->getMatch('EUW1_1234567890');

// Teamfight Tactics
$tftMatch    = Phizz::tft()->matchV1->getMatch('EUW1_1234567890');
$tftLeague   = Phizz::tft()->leagueV1->getChallengerLeague();
$tftSummoner = Phizz::tft()->summonerV1->getByPuuid($puuid);

// Valorant
$valMatch  = Phizz::val()->matchV1->getMatch($matchId);
$valLeaderboard = Phizz::val()->rankedV1->getLeaderboard('e7a1');

// Legends of Runeterra
$lorMatch = Phizz::lor()->matchV1->getMatch($matchId);
$lorLeaderboard = Phizz::lor()->rankedV1->getLeaderboards();

// Account (cross-game)
$account = Phizz::riot()->accountV1->getByRiotId('EUW', 'IAmTheWHite');
```

## Supported APIs

### Cross-game (`riot`)
| API | Version |
|-----|---------|
| Account | V1 |

### League of Legends (`lol`)
| API | Version |
|-----|---------|
| Champion Mastery | V4 |
| Champion | V3 |
| Clash | V1 |
| League EXP | V4 |
| League | V4 |
| Challenges | V1 |
| RSO Match | V1 |
| Status | V4 |
| Match | V5 |
| Spectator | V5 |
| Summoner | V4 |
| Tournament Stub | V5 |
| Tournament | V5 |

### Valorant (`val`)
| API | Version |
|-----|---------|
| Console Match | V1 |
| Console Ranked | V1 |
| Content | V1 |
| Match | V1 |
| Ranked | V1 |
| Status | V1 |

### Teamfight Tactics (`tft`)
| API | Version |
|-----|---------|
| Spectator | V5 |
| League | V1 |
| Match | V1 |
| Status | V1 |
| Summoner | V1 |

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

## Platforms & Regions

```php
use Phizz\Enums\Platform;   // na1, euw1, kr, br1, ...
use Phizz\Enums\Regional;   // Americas, Europe, Asia, SEA
use Phizz\Enums\ValPlatform; // NA, EU, AP, KR, BR, LatAm, Esports
```

Platforms convert to regionals automatically where needed (e.g. `Platform::EUW` → `Regional::Europe`).

## Testing

```bash
composer test
composer test-coverage
composer analyse
composer format
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
