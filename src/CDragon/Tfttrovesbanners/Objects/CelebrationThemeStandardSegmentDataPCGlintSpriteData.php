<?php

namespace Phizz\CDragon\Tfttrovesbanners\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $spritesheet_path
 * @property-read float $duration
 * @property-read float $delay
 * @property-read int $num_rows
 * @property-read int $num_cols
 * @property-read int $num_frames
 * @property-read int $start_frame
 * @property-read int $fps
 * @property-read int $max_play_count
 * @property-read bool $play_at_insert
 */
class CelebrationThemeStandardSegmentDataPCGlintSpriteData extends StaticData
{
    public function spritesheetUrl(): string
    {
        return $this->toUrl($this->spritesheet_path);
    }
}
