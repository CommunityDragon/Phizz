<?php

namespace Phizz\CDragon\Lolcurrency\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $lol_currency_id
 * @property-read string $cap_currency_id
 * @property-read string $title
 * @property-read string $description
 * @property-read string $icon_path
 * @property-read int $priority
 */
class LolcurrencyData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }
}
