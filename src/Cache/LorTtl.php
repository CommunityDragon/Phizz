<?php

namespace Phizz\Cache;

use Phizz\Cache\Lor\DeckV1Ttl;
use Phizz\Cache\Lor\InventoryV1Ttl;
use Phizz\Cache\Lor\MatchV1Ttl;
use Phizz\Cache\Lor\RankedV1Ttl;
use Phizz\Cache\Lor\StatusV1Ttl;

/**
 * @internal
 *
 * @property-read class-string<DeckV1Ttl> $deckV1
 * @property-read class-string<InventoryV1Ttl> $inventoryV1
 * @property-read class-string<MatchV1Ttl> $matchV1
 * @property-read class-string<RankedV1Ttl> $rankedV1
 * @property-read class-string<StatusV1Ttl> $statusV1
 */
final class LorTtl
{
    public const deckV1 = DeckV1Ttl::class;

    public const inventoryV1 = InventoryV1Ttl::class;

    public const matchV1 = MatchV1Ttl::class;

    public const rankedV1 = RankedV1Ttl::class;

    public const statusV1 = StatusV1Ttl::class;

    private function __construct() {}
}
