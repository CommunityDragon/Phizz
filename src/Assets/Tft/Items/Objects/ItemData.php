<?php

namespace Phizz\Assets\Tft\Items\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $guid
 * @property-read string $name
 * @property-read string $name_id
 * @property-read int $id
 * @property-read ColorData $color
 * @property-read string $square_icon_path
 */
class ItemData extends StaticData
{
    protected array $objects = [
        'color' => ColorData::class,
    ];

    public function squareIconUrl(): string
    {
        return $this->toUrl($this->square_icon_path);
    }
}
