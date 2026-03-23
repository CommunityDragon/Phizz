<?php

namespace Phizz\Assets\Lol\StrawberryHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read string $description
 * @property-read string $icon_image
 * @property-read Collection<int, PowerUpGroupValueBoonData> $boons
 * @property-read PowerUpGroupValuePrerequisiteBoonData $prerequisiteBoon
 */
class PowerUpGroupValueData extends StaticData
{
    protected array $objects = [
        'prerequisite_boon' => PowerUpGroupValuePrerequisiteBoonData::class,
    ];

    protected array $collections = [
        'boons' => PowerUpGroupValueBoonData::class,
    ];
}
