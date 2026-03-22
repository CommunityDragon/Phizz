<?php

namespace Phizz\CDragon\Tftitems\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $guid
 * @property-read string $name
 * @property-read string $name_id
 * @property-read int $id
 * @property-read ColorData $color
 * @property-read string $square_icon_path
 */
class TftitemData extends StaticData
{
    protected array $objects = [
        'color' => ColorData::class,
    ];

    public function squareIconUrl(): string
    {
        return $this->toUrl($this->square_icon_path);
    }
}
