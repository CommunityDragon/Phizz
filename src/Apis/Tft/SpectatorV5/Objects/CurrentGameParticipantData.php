<?php

namespace Phizz\Apis\Tft\SpectatorV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $champion_id The ID of the champion played by this participant
 * @property-read int $profile_icon_id The ID of the profile icon used by this participant
 * @property-read int $team_id The team ID of this participant, indicating the participant's team
 * @property-read string $puuid The encrypted puuid of this participant. null when the player is anonym.
 * @property-read int $spell_1_id The ID of the first summoner spell used by this participant
 * @property-read int $spell_2_id The ID of the second summoner spell used by this participant
 * @property-read string $riot_id
 * @property-read Collection<int, GameCustomizationObjectData> $gameCustomizationObjects List of Game Customizations
 * @property-read PerksData $perks
 */
class CurrentGameParticipantData extends Data
{
    protected array $collections = [
        'game_customization_objects' => GameCustomizationObjectData::class,
    ];

    protected array $objects = [
        'perks' => PerksData::class,
    ];
}
