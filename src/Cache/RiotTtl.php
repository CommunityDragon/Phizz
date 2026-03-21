<?php

namespace Phizz\Cache;

use Phizz\Cache\Riot\AccountV1Ttl;

/**
 * @internal
 *
 * @property-read class-string<AccountV1Ttl> $accountV1
 */
final class RiotTtl
{
    public const accountV1 = AccountV1Ttl::class;

    private function __construct() {}
}
