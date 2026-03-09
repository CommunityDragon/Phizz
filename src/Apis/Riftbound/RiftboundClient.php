<?php

namespace Phizz\Apis\Riftbound;

use Phizz\Apis\Riftbound\ContentV1\ContentV1Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property ContentV1Api $contentV1
 *
 * @method ContentV1Api contentV1(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class RiftboundClient extends Constructable
{
    protected array $constructable = ['contentV1' => ContentV1Api::class];
}
