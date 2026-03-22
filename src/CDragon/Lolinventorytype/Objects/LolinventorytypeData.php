<?php

namespace Phizz\CDragon\Lolinventorytype\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $inventory_type_id
 * @property-read string $cap_inventory_type_id
 * @property-read bool $gip_aware
 * @property-read string $gip_json_path
 * @property-read bool $gip_is_map
 * @property-read string $gip_item_id
 * @property-read string $gip_name
 * @property-read string $gip_description
 * @property-read string $gip_image
 * @property-read string $vcbp_path
 */
class LolinventorytypeData extends StaticData
{
    public function gipJsonUrl(): string
    {
        return $this->toUrl($this->gip_json_path);
    }
}
