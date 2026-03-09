<?php

namespace Phizz\Apis\Riot;

use Phizz\Apis\Riot\AccountV1\AccountV1Api;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;
use Phizz\Support\Constructable;

/**
 * @property AccountV1Api $accountV1
 *
 * @method AccountV1Api accountV1(Regional|Platform|ValPlatform|string|null $platform = null)
 */
class RiotClient extends Constructable
{
    protected array $constructable = ['accountV1' => AccountV1Api::class];
}
