<?php

namespace Phizz;

use Phizz\Cache\LolTtl;
use Phizz\Cache\LorTtl;
use Phizz\Cache\RiftboundTtl;
use Phizz\Cache\RiotTtl;
use Phizz\Cache\TftTtl;
use Phizz\Cache\ValTtl;

/**
 * @property-read class-string<RiotTtl> $riot
 * @property-read class-string<LolTtl> $lol
 * @property-read class-string<LorTtl> $lor
 * @property-read class-string<RiftboundTtl> $riftbound
 * @property-read class-string<TftTtl> $tft
 * @property-read class-string<ValTtl> $val
 */
class TTL
{
    public const riot = RiotTtl::class;

    public const lol = LolTtl::class;

    public const lor = LorTtl::class;

    public const riftbound = RiftboundTtl::class;

    public const tft = TftTtl::class;

    public const val = ValTtl::class;

    private function __construct() {}
}
