<?php

namespace Phizz\Assets\Lol\EventHub\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read string $event_id
 * @property-read string $event_hub_type
 * @property-read string|null $season_pass_sub_type
 * @property-read string $localized_name
 * @property-read string $navbar_icon_image
 * @property-read string|null $battle_exp_icon_image
 * @property-read string $start_date
 * @property-read string $progress_end_date
 * @property-read string $end_date
 * @property-read EventRewardTrackData $rewardTrack
 * @property-read Collection<int, EventEventPassBundlesCatalogEntryData> $eventPassBundlesCatalogEntry
 * @property-read EventProgressionPurchaseCatalogEntryData $progressionPurchaseCatalogEntry
 * @property-read string $help_modal_image
 * @property-read string $objective_banner_image
 * @property-read string|null $localized_season_logo
 * @property-read string|null $localized_short_name
 * @property-read Collection<int, EventChapterData> $chapters
 * @property-read string|null $act_background_image
 * @property-read string|null $localized_event_subtitle
 * @property-read string|null $localized_help_url
 * @property-read bool|null $is_game_mode_event
 * @property-read int|null $queue_id
 * @property-read string|null $localized_logo
 * @property-read string|null $background_image
 * @property-read EventObjectiveCardData $objectiveCard
 * @property-read string|null $header_icon_image
 * @property-read string|null $header_title_image
 * @property-read Collection<int, EventQuestSkinLineDataEntryData> $questSkinLineDataEntries
 * @property-read string|null $inductee_name
 * @property-read EventSpotlightSkinData $spotlightSkin
 * @property-read Collection<int, EventNarrativeElementData> $narrativeElements
 * @property-read string|null $promotion_banner_image
 * @property-read string|null $localized_upsell_title
 * @property-read string|null $localized_upsell_tooltip_title
 * @property-read string|null $localized_upsell_tooltip_description
 * @property-read string|null $localized_upsell_button_text
 * @property-read string|null $upsell_background_image_url
 * @property-read string|null $upsell_tooltip_background_image_url
 * @property-read string|null $upsell_icon_url
 * @property-read string|null $memory_book_background_image
 */
class EventData extends StaticData
{
    protected array $objects = [
        'reward_track' => EventRewardTrackData::class,
        'progression_purchase_catalog_entry' => EventProgressionPurchaseCatalogEntryData::class,
        'objective_card' => EventObjectiveCardData::class,
        'spotlight_skin' => EventSpotlightSkinData::class,
    ];

    protected array $collections = [
        'event_pass_bundles_catalog_entry' => EventEventPassBundlesCatalogEntryData::class,
        'chapters' => EventChapterData::class,
        'quest_skin_line_data_entries' => EventQuestSkinLineDataEntryData::class,
        'narrative_elements' => EventNarrativeElementData::class,
    ];
}
