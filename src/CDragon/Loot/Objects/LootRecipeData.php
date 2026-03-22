<?php

namespace Phizz\CDragon\Loot\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $id
 * @property-read string $description
 * @property-read string $context_menu_text
 * @property-read string $requirement_text
 * @property-read string $image_path
 * @property-read string $intro_video_path
 * @property-read string $loop_video_path
 * @property-read string $outro_video_path
 * @property-read bool $has_visible_loot_odds
 * @property-read Collection<int, LootRecipeOutputData> $outputs
 */
class LootRecipeData extends StaticData
{
    protected array $collections = [
        'outputs' => LootRecipeOutputData::class,
    ];

    public function imageUrl(): string
    {
        return $this->toUrl($this->image_path);
    }
}
