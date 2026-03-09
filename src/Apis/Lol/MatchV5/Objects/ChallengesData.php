<?php

namespace Phizz\Apis\Lol\MatchV5\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\Data;

/**
 * @property-read int $twelve_assist_streak_count
 * @property-read int $baron_buff_gold_advantage_over_threshold
 * @property-read float $control_ward_time_coverage_in_river_or_enemy_half
 * @property-read float $earliest_baron
 * @property-read float $earliest_dragon_takedown
 * @property-read float $earliest_elder_dragon
 * @property-read float $early_laning_phase_gold_exp_advantage
 * @property-read int $faster_support_quest_completion
 * @property-read float $fastest_legendary
 * @property-read int $had_afk_teammate
 * @property-read int $highest_champion_damage
 * @property-read int $highest_crowd_control_score
 * @property-read int $highest_ward_kills
 * @property-read int $jungler_kills_early_jungle
 * @property-read int $kills_on_laners_early_jungle_as_jungler
 * @property-read int $laning_phase_gold_exp_advantage
 * @property-read int $legendary_count
 * @property-read float $max_cs_advantage_on_lane_opponent
 * @property-read int $max_level_lead_lane_opponent
 * @property-read int $most_wards_destroyed_one_sweeper
 * @property-read int $mythic_item_used
 * @property-read int $played_champ_select_position
 * @property-read int $solo_turrets_lategame
 * @property-read int $takedowns_first_25_minutes
 * @property-read int $teleport_takedowns
 * @property-read float $third_inhibitor_destroyed_time
 * @property-read int $three_wards_one_sweeper_count
 * @property-read float $vision_score_advantage_lane_opponent
 * @property-read int $infernal_scale_pickup
 * @property-read int $fist_bump_participation
 * @property-read int $void_monster_kill
 * @property-read int $ability_uses
 * @property-read int $aces_before_15_minutes
 * @property-read float $allied_jungle_monster_kills
 * @property-read int $baron_takedowns
 * @property-read int $blast_cone_opposite_opponent_count
 * @property-read float $bounty_gold
 * @property-read int $buffs_stolen
 * @property-read int $complete_support_quest_in_time
 * @property-read int $control_wards_placed
 * @property-read float $damage_per_minute
 * @property-read float $damage_taken_on_team_percentage
 * @property-read int $danced_with_rift_herald
 * @property-read int $deaths_by_enemy_champs
 * @property-read int $dodge_skill_shots_small_window
 * @property-read int $double_aces
 * @property-read int $dragon_takedowns
 * @property-read float $effective_heal_and_shielding
 * @property-read int $elder_dragon_kills_with_opposing_soul
 * @property-read int $elder_dragon_multikills
 * @property-read int $enemy_champion_immobilizations
 * @property-read float $enemy_jungle_monster_kills
 * @property-read int $epic_monster_kills_near_enemy_jungler
 * @property-read int $epic_monster_kills_within_30_seconds_of_spawn
 * @property-read int $epic_monster_steals
 * @property-read int $epic_monster_stolen_without_smite
 * @property-read float $first_turret_killed
 * @property-read float $first_turret_killed_time
 * @property-read int $flawless_aces
 * @property-read int $full_team_takedown
 * @property-read float $game_length
 * @property-read int $get_takedowns_in_all_lanes_early_jungle_as_laner
 * @property-read float $gold_per_minute
 * @property-read int $had_open_nexus
 * @property-read int $immobilize_and_kill_with_ally
 * @property-read int $initial_buff_count
 * @property-read int $initial_crab_count
 * @property-read float $jungle_cs_before_10_minutes
 * @property-read int $jungler_takedowns_near_damaged_epic_monster
 * @property-read float $kda
 * @property-read int $kill_after_hidden_with_ally
 * @property-read int $killed_champ_took_full_team_damage_survived
 * @property-read int $killing_sprees
 * @property-read float $kill_participation
 * @property-read int $kills_near_enemy_turret
 * @property-read int $kills_on_other_lanes_early_jungle_as_laner
 * @property-read int $kills_on_recently_healed_by_aram_pack
 * @property-read int $kills_under_own_turret
 * @property-read int $kills_with_help_from_epic_monster
 * @property-read int $knock_enemy_into_team_and_kill
 * @property-read int $k_turrets_destroyed_before_plates_fall
 * @property-read int $land_skill_shots_early_game
 * @property-read int $lane_minions_first_10_minutes
 * @property-read int $lost_an_inhibitor
 * @property-read int $max_kill_deficit
 * @property-read int $mejais_full_stack_in_time
 * @property-read float $more_enemy_jungle_than_opponent
 * @property-read int $multi_kill_one_spell This is an offshoot of the OneStone challenge. The code checks if a spell with the same instance ID does the final point of damage to at least 2 Champions. It doesn't matter if they're enemies, but you cannot hurt your friends.
 * @property-read int $multikills
 * @property-read int $multikills_after_aggressive_flash
 * @property-read int $multi_turret_rift_herald_count
 * @property-read int $outer_turret_executes_before_10_minutes
 * @property-read int $outnumbered_kills
 * @property-read int $outnumbered_nexus_kill
 * @property-read int $perfect_dragon_souls_taken
 * @property-read int $perfect_game
 * @property-read int $pick_kill_with_ally
 * @property-read int $poro_explosions
 * @property-read int $quick_cleanse
 * @property-read int $quick_first_turret
 * @property-read int $quick_solo_kills
 * @property-read int $rift_herald_takedowns
 * @property-read int $save_ally_from_death
 * @property-read int $scuttle_crab_kills
 * @property-read float $shortest_time_to_ace_from_first_takedown
 * @property-read int $skillshots_dodged
 * @property-read int $skillshots_hit
 * @property-read int $snowballs_hit
 * @property-read int $solo_baron_kills
 * @property-read int $swarm_defeat_aatrox
 * @property-read int $swarm_defeat_briar
 * @property-read int $swarm_defeat_mini_bosses
 * @property-read int $swarm_evolve_weapon
 * @property-read int $swarm_have_3_passives
 * @property-read int $swarm_kill_enemy
 * @property-read float $swarm_pickup_gold
 * @property-read int $swarm_reach_level_50
 * @property-read int $swarm_survive_15_min
 * @property-read int $swarm_win_with_5_evolved_weapons
 * @property-read int $solo_kills
 * @property-read int $stealth_wards_placed
 * @property-read int $survived_single_digit_hp_count
 * @property-read int $survived_three_immobilizes_in_fight
 * @property-read int $takedown_on_first_turret
 * @property-read int $takedowns
 * @property-read int $takedowns_after_gaining_level_advantage
 * @property-read int $takedowns_before_jungle_minion_spawn
 * @property-read int $takedowns_first_x_minutes
 * @property-read int $takedowns_in_alcove
 * @property-read int $takedowns_in_enemy_fountain
 * @property-read int $team_baron_kills
 * @property-read float $team_damage_percentage
 * @property-read int $team_elder_dragon_kills
 * @property-read int $team_rift_herald_kills
 * @property-read int $took_large_damage_survived
 * @property-read int $turret_plates_taken
 * @property-read int $turrets_taken_with_rift_herald Any player who damages a tower that is destroyed within 30 seconds of a Rift Herald charge will receive credit. A player who does not damage the tower will not receive credit.
 * @property-read int $turret_takedowns
 * @property-read int $twenty_minions_in_3_seconds_count
 * @property-read int $two_wards_one_sweeper_count
 * @property-read int $unseen_recalls
 * @property-read float $vision_score_per_minute
 * @property-read int $wards_guarded
 * @property-read int $ward_takedowns
 * @property-read int $ward_takedowns_before_20m
 * @property-read float $heal_from_map_sources
 * @property-read Collection<int, int> $legendaryItemUsed
 */
class ChallengesData extends Data
{
    protected array $collections = [
        'legendary_item_used',
    ];
}
