<?php

namespace Phizz\Apis\Val;

use Phizz\Apis\Val\ConsoleMatchV1\ConsoleMatchV1Api;
use Phizz\Apis\Val\ConsoleRankedV1\ConsoleRankedV1Api;
use Phizz\Apis\Val\ContentV1\ContentV1Api;
use Phizz\Apis\Val\MatchV1\MatchV1Api;
use Phizz\Apis\Val\RankedV1\RankedV1Api;
use Phizz\Apis\Val\StatusV1\StatusV1Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property ConsoleMatchV1Api $consoleMatchV1
 * @property ConsoleRankedV1Api $consoleRankedV1
 * @property ContentV1Api $contentV1
 * @property MatchV1Api $matchV1
 * @property RankedV1Api $rankedV1
 * @property StatusV1Api $statusV1
 *
 * @method ConsoleMatchV1Api consoleMatchV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ConsoleRankedV1Api consoleRankedV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ContentV1Api contentV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method MatchV1Api matchV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method RankedV1Api rankedV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method StatusV1Api statusV1(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class ValClient extends Constructable
{
    protected array $constructable = [
        'consoleMatchV1' => ConsoleMatchV1Api::class,
        'consoleRankedV1' => ConsoleRankedV1Api::class,
        'contentV1' => ContentV1Api::class,
        'matchV1' => MatchV1Api::class,
        'rankedV1' => RankedV1Api::class,
        'statusV1' => StatusV1Api::class,
    ];
}
