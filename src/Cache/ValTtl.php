<?php

namespace Phizz\Cache;

use Phizz\Cache\Val\ConsoleMatchV1Ttl;
use Phizz\Cache\Val\ConsoleRankedV1Ttl;
use Phizz\Cache\Val\ContentV1Ttl;
use Phizz\Cache\Val\MatchV1Ttl;
use Phizz\Cache\Val\RankedV1Ttl;
use Phizz\Cache\Val\StatusV1Ttl;

/**
 * @internal
 *
 * @property-read class-string<ConsoleMatchV1Ttl> $consoleMatchV1
 * @property-read class-string<ConsoleRankedV1Ttl> $consoleRankedV1
 * @property-read class-string<ContentV1Ttl> $contentV1
 * @property-read class-string<MatchV1Ttl> $matchV1
 * @property-read class-string<RankedV1Ttl> $rankedV1
 * @property-read class-string<StatusV1Ttl> $statusV1
 */
final class ValTtl
{
    public const consoleMatchV1 = ConsoleMatchV1Ttl::class;

    public const consoleRankedV1 = ConsoleRankedV1Ttl::class;

    public const contentV1 = ContentV1Ttl::class;

    public const matchV1 = MatchV1Ttl::class;

    public const rankedV1 = RankedV1Ttl::class;

    public const statusV1 = StatusV1Ttl::class;

    private function __construct() {}
}
