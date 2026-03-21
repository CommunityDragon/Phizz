<?php

namespace Phizz\Apis\Lor\InventoryV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lor\InventoryV1\Objects\CardData;
use Phizz\Cache\Lor\InventoryV1Ttl;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class InventoryV1Api extends Api
{
    /**
     * @returns Collection<int, CardData>
     */
    public function getCards(Regional|Platform|string|null $platform = null, bool $force = false): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/inventory/v1/cards/me',
            cacheKey: InventoryV1Ttl::getCards,
            returns: true,
            platformType: Regional::class,
            collectionType: CardData::class,
            platform: $platform,
            force: $force,
        );
    }
}
