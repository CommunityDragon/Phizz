<?php

namespace Phizz\Apis\Lor\DeckV1;

use Illuminate\Support\Collection;
use Phizz\Apis\Lor\DeckV1\Objects\DeckData;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Support\Api;

class DeckV1Api extends Api
{
    /**
     * @returns Collection<int, DeckData>
     */
    public function getDecks(Regional|Platform|string|null $platform = null): Collection
    {
        return $this->fetch(
            method: 'GET',
            endpoint: '/lor/deck/v1/decks/me',
            returns: true,
            platformType: Regional::class,
            collectionType: DeckData::class,
            platform: $platform,
        );
    }

    /**
     * @returns string
     */
    public function createDeck(Regional|Platform|string|null $platform = null): string
    {
        return $this->fetch(
            method: 'POST',
            endpoint: '/lor/deck/v1/decks/me',
            returns: true,
            platformType: Regional::class,
            platform: $platform,
        );
    }
}
