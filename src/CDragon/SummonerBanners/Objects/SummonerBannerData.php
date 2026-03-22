<?php

namespace Phizz\CDragon\SummonerBanners\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read Collection<int, BannerFlagData> $bannerFlags
 * @property-read Collection<int, BannerFrameData> $bannerFrames
 */
class SummonerBannerData extends StaticData
{
    protected array $collections = [
        'banner_flags' => BannerFlagData::class,
        'banner_frames' => BannerFrameData::class,
    ];
}
