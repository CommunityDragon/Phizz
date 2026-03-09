<?php

namespace Phizz\Support;

use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;

class Configuration
{
    public function __construct(
        public readonly string $apiKey,
        public readonly Regional|Platform|ValPlatform|string|null $platform,
    ) {}
}
