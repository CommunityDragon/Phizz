<?php

namespace Phizz\CDragon\Regalia\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $content_id
 * @property-read string $id_secondary
 * @property-read string $asset_path
 * @property-read bool $is_selectable
 * @property-read string $regalia_type
 * @property-read string $localized_name
 * @property-read string $localized_description
 * @property-read bool $is_tencent_only
 */
class RegaliumData extends StaticData
{
    public function assetUrl(): string
    {
        return $this->toUrl($this->asset_path);
    }
}
