<?php

namespace Phizz\Assets\Lol\NexusFinishers\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read string $name
 * @property-read int $item_id
 * @property-read string $content_id
 * @property-read string $translated_name
 * @property-read string $translated_description
 * @property-read string $icon_path
 * @property-read string $splash_path
 * @property-read string $video_path
 */
class NexusFinisherData extends StaticData
{
    public function iconUrl(): string
    {
        return $this->toUrl($this->icon_path);
    }

    public function splashUrl(): string
    {
        return $this->toUrl($this->splash_path);
    }

    public function videoUrl(): string
    {
        return $this->toUrl($this->video_path);
    }
}
