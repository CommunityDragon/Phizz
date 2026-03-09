<?php

namespace Phizz\Apis\Riot\AccountV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid Player Universal Unique Identifier. Exact length of 78 characters. (Encrypted)
 * @property-read string $game Game to lookup active region
 * @property-read string $region Player active region
 */
class AccountRegionData extends Data {}
