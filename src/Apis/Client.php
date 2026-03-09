<?php

namespace Phizz\Apis;

use Phizz\Apis\Lol\LolClient;
use Phizz\Apis\Lor\LorClient;
use Phizz\Apis\Riftbound\RiftboundClient;
use Phizz\Apis\Riot\RiotClient;
use Phizz\Apis\Tft\TftClient;
use Phizz\Apis\Val\ValClient;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property RiotClient $riot
 * @property LolClient $lol
 * @property LorClient $lor
 * @property RiftboundClient $riftbound
 * @property TftClient $tft
 * @property ValClient $val
 *
 * @method RiotClient riot(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method LolClient lol(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method LorClient lor(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method RiftboundClient riftbound(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method TftClient tft(Regional|Platform|ValPlatform|string|null $platform = null)
 * @method ValClient val(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class Client extends Constructable
{
    protected array $constructable = [
        'riot' => RiotClient::class,
        'lol' => LolClient::class,
        'lor' => LorClient::class,
        'riftbound' => RiftboundClient::class,
        'tft' => TftClient::class,
        'val' => ValClient::class,
    ];
}
