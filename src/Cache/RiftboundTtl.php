<?php

namespace Phizz\Cache;

use Phizz\Cache\Riftbound\ContentV1Ttl;

/**
 * @internal
 *
 * @property-read class-string<ContentV1Ttl> $contentV1
 */
final class RiftboundTtl
{
    public const contentV1 = ContentV1Ttl::class;

    private function __construct() {}
}
