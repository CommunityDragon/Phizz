<?php

namespace Phizz\Assets\Tft\CosmeticsDefault\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read PlaybookData $playbook
 */
class CosmeticsDefaultData extends StaticData
{
    protected array $objects = [
        'playbook' => PlaybookData::class,
    ];
}
