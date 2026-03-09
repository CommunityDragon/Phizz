<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Phizz\Support\Data;

/**
 * @property-read int $all_in_pings Yellow crossed swords
 * @property-read int $assist_me_pings Green flag
 * @property-read int $assists
 * @property-read int $baron_kills
 * @property-read int $bounty_level
 * @property-read int $champ_experience
 * @property-read int $champ_level
 * @property-read int $champion_id Prior to patch 11.4, on Feb 18th, 2021, this field returned invalid championIds. We recommend determining the champion based on the championName field for matches played prior to patch 11.4.
 * @property-read string $champion_name
 * @property-read int $command_pings Blue generic ping (ALT+click)
 * @property-read int $champion_transform This field is currently only utilized for Kayn's transformations. (Legal values: 0 - None, 1 - Slayer, 2 - Assassin)
 * @property-read int $consumables_purchased
 * @property-read int $damage_dealt_to_buildings
 * @property-read int $damage_dealt_to_objectives
 * @property-read int $damage_dealt_to_turrets
 * @property-read int $damage_self_mitigated
 * @property-read int $deaths
 * @property-read int $detector_wards_placed
 * @property-read int $double_kills
 * @property-read int $dragon_kills
 * @property-read bool $eligible_for_progression
 * @property-read int $enemy_missing_pings Yellow questionmark
 * @property-read int $enemy_vision_pings Red eyeball
 * @property-read bool $first_blood_assist
 * @property-read bool $first_blood_kill
 * @property-read bool $first_tower_assist
 * @property-read bool $first_tower_kill
 * @property-read bool $game_ended_in_early_surrender This is an offshoot of the OneStone challenge. The code checks if a spell with the same instance ID does the final point of damage to at least 2 Champions. It doesn't matter if they're enemies, but you cannot hurt your friends.
 * @property-read bool $game_ended_in_surrender
 * @property-read int $hold_pings
 * @property-read int $get_back_pings Yellow circle with horizontal line
 * @property-read int $gold_earned
 * @property-read int $gold_spent
 * @property-read string $individual_position Both individualPosition and teamPosition are computed by the game server and are different versions of the most likely position played by a player. The individualPosition is the best guess for which position the player actually played in isolation of anything else. The teamPosition is the best guess for which position the player actually played if we add the constraint that each team must have one top player, one jungle, one middle, etc. Generally the recommendation is to use the teamPosition field over the individualPosition field.
 * @property-read int $inhibitor_kills
 * @property-read int $inhibitor_takedowns
 * @property-read int $inhibitors_lost
 * @property-read int $item_0
 * @property-read int $item_1
 * @property-read int $item_2
 * @property-read int $item_3
 * @property-read int $item_4
 * @property-read int $item_5
 * @property-read int $item_6
 * @property-read int $items_purchased
 * @property-read int $killing_sprees
 * @property-read int $kills
 * @property-read string $lane
 * @property-read int $largest_critical_strike
 * @property-read int $largest_killing_spree
 * @property-read int $largest_multi_kill
 * @property-read int $longest_time_spent_living
 * @property-read int $magic_damage_dealt
 * @property-read int $magic_damage_dealt_to_champions
 * @property-read int $magic_damage_taken
 * @property-read int $neutral_minions_killed neutralMinionsKilled = mNeutralMinionsKilled, which is incremented on kills of kPet and kJungleMonster
 * @property-read int $need_vision_pings Green ward
 * @property-read int $nexus_kills
 * @property-read int $nexus_takedowns
 * @property-read int $nexus_lost
 * @property-read int $objectives_stolen
 * @property-read int $objectives_stolen_assists
 * @property-read int $on_my_way_pings Blue arrow pointing at ground
 * @property-read int $participant_id
 * @property-read float $player_score_0
 * @property-read float $player_score_1
 * @property-read float $player_score_2
 * @property-read float $player_score_3
 * @property-read float $player_score_4
 * @property-read float $player_score_5
 * @property-read float $player_score_6
 * @property-read float $player_score_7
 * @property-read float $player_score_8
 * @property-read float $player_score_9
 * @property-read float $player_score_10
 * @property-read float $player_score_11
 * @property-read int $penta_kills
 * @property-read int $physical_damage_dealt
 * @property-read int $physical_damage_dealt_to_champions
 * @property-read int $physical_damage_taken
 * @property-read int $placement
 * @property-read int $player_augment_1
 * @property-read int $player_augment_2
 * @property-read int $player_augment_3
 * @property-read int $player_augment_4
 * @property-read int $player_subteam_id
 * @property-read int $push_pings Green minion
 * @property-read int $profile_icon
 * @property-read string $puuid
 * @property-read int $quadra_kills
 * @property-read string $riot_id_game_name
 * @property-read string $riot_id_tagline
 * @property-read string $role
 * @property-read int $sight_wards_bought_in_game
 * @property-read int $spell_1_casts
 * @property-read int $spell_2_casts
 * @property-read int $spell_3_casts
 * @property-read int $spell_4_casts
 * @property-read int $subteam_placement
 * @property-read int $summoner_1_casts
 * @property-read int $summoner_1_id
 * @property-read int $summoner_2_casts
 * @property-read int $summoner_2_id
 * @property-read string $summoner_id
 * @property-read int $summoner_level
 * @property-read string $summoner_name
 * @property-read bool $team_early_surrendered
 * @property-read int $team_id
 * @property-read string $team_position Both individualPosition and teamPosition are computed by the game server and are different versions of the most likely position played by a player. The individualPosition is the best guess for which position the player actually played in isolation of anything else. The teamPosition is the best guess for which position the player actually played if we add the constraint that each team must have one top player, one jungle, one middle, etc. Generally the recommendation is to use the teamPosition field over the individualPosition field.
 * @property-read int $time_ccing_others
 * @property-read int $time_played
 * @property-read int $total_ally_jungle_minions_killed
 * @property-read int $total_damage_dealt
 * @property-read int $total_damage_dealt_to_champions
 * @property-read int $total_damage_shielded_on_teammates
 * @property-read int $total_damage_taken
 * @property-read int $total_enemy_jungle_minions_killed
 * @property-read int $total_heal Whenever positive health is applied (which translates to all heals in the game but not things like regeneration), totalHeal is incremented by the amount of health received. This includes healing enemies, jungle monsters, yourself, etc
 * @property-read int $total_heals_on_teammates Whenever positive health is applied (which translates to all heals in the game but not things like regeneration), totalHealsOnTeammates is incremented by the amount of health received.  This is post modified, so if you heal someone missing 5 health for 100 you will get +5 totalHealsOnTeammates
 * @property-read int $total_minions_killed totalMillionsKilled = mMinionsKilled, which is only incremented on kills of kTeamMinion, kMeleeLaneMinion, kSuperLaneMinion, kRangedLaneMinion and kSiegeLaneMinion
 * @property-read int $total_time_cc_dealt
 * @property-read int $total_time_spent_dead
 * @property-read int $total_units_healed
 * @property-read int $triple_kills
 * @property-read int $true_damage_dealt
 * @property-read int $true_damage_dealt_to_champions
 * @property-read int $true_damage_taken
 * @property-read int $turret_kills
 * @property-read int $turret_takedowns
 * @property-read int $turrets_lost
 * @property-read int $unreal_kills
 * @property-read int $vision_score
 * @property-read int $vision_cleared_pings
 * @property-read int $vision_wards_bought_in_game
 * @property-read int $wards_killed
 * @property-read int $wards_placed
 * @property-read bool $win
 * @property-read int $bait_pings
 * @property-read int $danger_pings https://github.com/RiotGames/developer-relations/issues/870
 * @property-read int $basic_pings https://github.com/RiotGames/developer-relations/issues/814
 * @property-read int $player_augment_5
 * @property-read int $player_augment_6
 * @property-read string $riot_id_name Deprecated, use `riotIdGameName`. This field name was briefly used instead of `riotIdGameName`, prior to patch 14.5.
 * @property-read int $retreat_pings https://github.com/RiotGames/developer-relations/issues/814
 * @property-read int $champion_skin_id
 * @property-read int $damage_dealt_to_epic_monsters
 * @property-read int $role_bound_item
 * @property-read ChallengesData $challenges Challenges DTO
 * @property-read MissionsData $missions Missions DTO
 * @property-read PerksData $perks
 * @property-read ParticipantPlayerBehaviorData $playerBehavior
 */
class ParticipantData extends Data
{
    protected array $objects = [
        'challenges' => ChallengesData::class,
        'missions' => MissionsData::class,
        'perks' => PerksData::class,
        'player_behavior' => ParticipantPlayerBehaviorData::class,
    ];
}
