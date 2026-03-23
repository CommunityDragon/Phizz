<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $event_id
 * @property-read string $event_hub_type
 * @property-read string $localized_name
 * @property-read string $navbar_icon_image
 * @property-read string $start_date
 * @property-read string $progress_end_date
 * @property-read string $end_date
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassEventPassBundlesCatalogEntryData> $eventPassBundlesCatalogEntry
 * @property-read string $help_modal_image
 * @property-read string $objective_banner_image
 * @property-read string $battle_exp_icon_image
 * @property-read ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassRewardTrackData $rewardTrack
 * @property-read string $season_pass_sub_type
 * @property-read string $localized_season_logo
 * @property-read string $localized_short_name
 * @property-read string $act_background_image
 * @property-read Collection<int, ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassChapterData> $chapters
 * @property-read ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassProgressionPurchaseCatalogEntryData $progressionPurchaseCatalogEntry
 */
class ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassData extends StaticData
{
    protected array $objects = [
        'reward_track' => ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassRewardTrackData::class,
        'progression_purchase_catalog_entry' => ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassProgressionPurchaseCatalogEntryData::class,
    ];

    protected array $collections = [
        'event_pass_bundles_catalog_entry' => ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassEventPassBundlesCatalogEntryData::class,
        'chapters' => ObjectivesGroupObjectivesCategoryEventHubConfigurationEventHubConfigurationEventSeasonPassChapterData::class,
    ];
}
