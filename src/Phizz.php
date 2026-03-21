<?php

namespace Phizz;

use Phizz\Apis\Client;
use Phizz\Support\Cache;
use Phizz\Support\Configuration;
use Phizz\Support\HttpClient;

class Phizz extends Client
{
    public function __construct(Configuration $config)
    {
        parent::__construct(
            config: $config,
            client: new HttpClient($config, new Cache($config)),
        );
    }
}
