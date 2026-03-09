<?php

namespace Phizz\Apis\Lor;

use Phizz\Apis\Lor\DeckV1\DeckV1Api;
use Phizz\Apis\Lor\InventoryV1\InventoryV1Api;
use Phizz\Apis\Lor\MatchV1\MatchV1Api;
use Phizz\Apis\Lor\RankedV1\RankedV1Api;
use Phizz\Apis\Lor\StatusV1\StatusV1Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property DeckV1Api $deckV1
 * @property InventoryV1Api $inventoryV1
 * @property MatchV1Api $matchV1
 * @property RankedV1Api $rankedV1
 * @property StatusV1Api $statusV1
 *
 * @method DeckV1Api deckV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method InventoryV1Api inventoryV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method MatchV1Api matchV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method RankedV1Api rankedV1(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method StatusV1Api statusV1(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class LorClient extends Constructable
{
    protected array $constructable = [
        'deckV1' => DeckV1Api::class,
        'inventoryV1' => InventoryV1Api::class,
        'matchV1' => MatchV1Api::class,
        'rankedV1' => RankedV1Api::class,
        'statusV1' => StatusV1Api::class,
    ];
}
