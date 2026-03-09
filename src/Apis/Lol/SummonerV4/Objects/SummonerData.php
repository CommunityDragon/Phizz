<?php

namespace Phizz\Apis\Lol\SummonerV4\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $profile_icon_id ID of the summoner icon associated with the summoner.
 * @property-read int $revision_date Date summoner was last modified specified as epoch milliseconds. The following events will update this timestamp: profile icon change, playing the tutorial or advanced tutorial, finishing a game, summoner name change.
 * @property-read string $puuid Encrypted PUUID. Exact length of 78 characters.
 * @property-read int $summoner_level Summoner level associated with the summoner.
 * @property-read string $id Encrypted summoner ID. This field is deprecated and will be removed. Use `puuid` instead.
 */
class SummonerData extends Data {}
