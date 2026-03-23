<?php

namespace Phizz;

use Phizz\Apis\Client;
use Phizz\Assets\AssetClient;
use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\Support\HttpClient;
use Phizz\Support\StaticClient;

class Phizz extends Client
{
    public function __construct(Configuration $config)
    {
        parent::__construct(
            config: $config,
            client: new HttpClient($config, new Cache($config)),
        );
    }

    public function cdragon(?string $version = null): AssetClient
    {
        return new AssetClient(
            version: $version ?? $this->config->cdragonVersion,
            http: new StaticClient,
        );
    }
}
