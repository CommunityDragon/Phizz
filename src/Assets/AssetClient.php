<?php

namespace Phizz\Assets;

use Phizz\Assets\Lol\LolClient;
use Phizz\Assets\Tft\TftClient;
use Phizz\Support\StaticApi;
use Phizz\Support\StaticClient;

class AssetClient extends StaticApi
{
    public readonly LolClient $lol;

    public readonly TftClient $tft;

    public function __construct(string $version, StaticClient $http)
    {
        parent::__construct($version, $http);
        $this->lol = new LolClient($version, $http);
        $this->tft = new TftClient($version, $http);
    }

    /**
     * Returns the CommunityDragon patch version this client is scoped to.
     */
    public function version(): string
    {
        return $this->version;
    }
}
