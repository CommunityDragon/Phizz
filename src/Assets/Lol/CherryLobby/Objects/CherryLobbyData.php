<?php

namespace Phizz\Assets\Lol\CherryLobby\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read ProgressTrackData $progressTrack
 * @property-read ChampionsCompletedTrackData $championsCompletedTrack
 * @property-read string $progression_modal_title
 * @property-read string $progression_modal_title_tooltip_title
 * @property-read string $progression_modal_title_tooltip_content
 * @property-read Collection<int, ChampionMissionLabelData> $championMissionLabels
 */
class CherryLobbyData extends StaticData
{
    protected array $objects = [
        'progress_track' => ProgressTrackData::class,
        'champions_completed_track' => ChampionsCompletedTrackData::class,
    ];

    protected array $collections = [
        'champion_mission_labels' => ChampionMissionLabelData::class,
    ];
}
