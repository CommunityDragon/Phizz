<?php

namespace Phizz\Apis\Riot\AccountV1\Objects;

use Phizz\Support\Data;

/**
 * @property-read string $puuid Encrypted PUUID. Exact length of 78 characters.
 * @property-read string $game_name This field may be excluded from the response if the account doesn't have a gameName.
 * @property-read string $tag_line This field may be excluded from the response if the account doesn't have a tagLine.
 */
class AccountData extends Data {}
