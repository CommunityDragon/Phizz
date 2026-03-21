<?php

namespace Phizz\Cache\Riot;

/**
 * @internal
 */
final class AccountV1Ttl
{
    public const getByPuuid = 'riot.accountV1.getByPuuid';

    public const getByRiotId = 'riot.accountV1.getByRiotId';

    public const getByAccessToken = 'riot.accountV1.getByAccessToken';

    public const getActiveShard = 'riot.accountV1.getActiveShard';

    public const getActiveRegion = 'riot.accountV1.getActiveRegion';

    private function __construct() {}
}
