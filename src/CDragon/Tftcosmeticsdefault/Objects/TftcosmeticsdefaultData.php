<?php

namespace Phizz\CDragon\Tftcosmeticsdefault\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read PlaybookData $playbook
 */
class TftcosmeticsdefaultData extends StaticData
{
    protected array $objects = [
        'playbook' => PlaybookData::class,
    ];
}
