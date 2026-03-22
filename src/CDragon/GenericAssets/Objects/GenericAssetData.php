<?php

namespace Phizz\CDragon\GenericAssets\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read GenericRewardGroupsAssetListData $genericRewardGroupsAssetList
 * @property-read ClashLogosData $clashLogos
 * @property-read MSI2024Data $msi2024
 * @property-read Sohh2024AudioData $sohh2024Audio
 * @property-read RegaliaBannerskinsDefaultData $regaliaBannerskinsDefault
 * @property-read RegaliaBannerskinsPastrankData $regaliaBannerskinsPastrank
 * @property-read RegaliaBannerPatternsData $regaliaBannerPatterns
 * @property-read RegaliaBannerTrimsData $regaliaBannerTrims
 * @property-read RegaliaRankedCrestLobbyIronData $regaliaRankedCrestLobbyIron
 * @property-read RegaliaRankedCrestLobbyBronzeData $regaliaRankedCrestLobbyBronze
 * @property-read RegaliaRankedCrestLobbySilverData $regaliaRankedCrestLobbySilver
 * @property-read RegaliaRankedCrestLobbyGoldData $regaliaRankedCrestLobbyGold
 * @property-read RegaliaRankedCrestLobbyPlatinumData $regaliaRankedCrestLobbyPlatinum
 * @property-read RegaliaRankedCrestLobbyDiamondData $regaliaRankedCrestLobbyDiamond
 * @property-read RegaliaRankedCrestLobbyMasterData $regaliaRankedCrestLobbyMaster
 * @property-read RegaliaRankedCrestLobbyGrandmasterData $regaliaRankedCrestLobbyGrandmaster
 * @property-read RegaliaRankedCrestLobbyChallengerData $regaliaRankedCrestLobbyChallenger
 * @property-read RegaliaRankedPromotionImagesData $regaliaRankedPromotionImages
 * @property-read TftRatedMiniBadgesRANKEDTFTPAIRSData $tftRatedMiniBadgesRankedTftPairs
 * @property-read TftRatedMiniBadgesRANKEDTFTTURBOData $tftRatedMiniBadgesRankedTftTurbo
 * @property-read TftRatedPostgameBadgesRANKEDTFTPAIRSData $tftRatedPostgameBadgesRankedTftPairs
 * @property-read TftRatedPostgameBadgesRANKEDTFTTURBOData $tftRatedPostgameBadgesRankedTftTurbo
 * @property-read StarShardsAssetsData $starShardsAssets
 * @property-read UnreferencedMageseekerRewardsData $unreferencedMageseekerRewards
 */
class GenericAssetData extends StaticData
{
    protected array $objects = [
        'generic_reward_groups_asset_list' => GenericRewardGroupsAssetListData::class,
        'clash_logos' => ClashLogosData::class,
        'msi_2024' => MSI2024Data::class,
        'sohh_2024_audio' => Sohh2024AudioData::class,
        'regalia_bannerskins_default' => RegaliaBannerskinsDefaultData::class,
        'regalia_bannerskins_pastrank' => RegaliaBannerskinsPastrankData::class,
        'regalia_banner_patterns' => RegaliaBannerPatternsData::class,
        'regalia_banner_trims' => RegaliaBannerTrimsData::class,
        'regalia_ranked_crest_lobby_iron' => RegaliaRankedCrestLobbyIronData::class,
        'regalia_ranked_crest_lobby_bronze' => RegaliaRankedCrestLobbyBronzeData::class,
        'regalia_ranked_crest_lobby_silver' => RegaliaRankedCrestLobbySilverData::class,
        'regalia_ranked_crest_lobby_gold' => RegaliaRankedCrestLobbyGoldData::class,
        'regalia_ranked_crest_lobby_platinum' => RegaliaRankedCrestLobbyPlatinumData::class,
        'regalia_ranked_crest_lobby_diamond' => RegaliaRankedCrestLobbyDiamondData::class,
        'regalia_ranked_crest_lobby_master' => RegaliaRankedCrestLobbyMasterData::class,
        'regalia_ranked_crest_lobby_grandmaster' => RegaliaRankedCrestLobbyGrandmasterData::class,
        'regalia_ranked_crest_lobby_challenger' => RegaliaRankedCrestLobbyChallengerData::class,
        'regalia_ranked_promotion_images' => RegaliaRankedPromotionImagesData::class,
        'tft_rated_mini_badges_ranked_tft_pairs' => TftRatedMiniBadgesRANKEDTFTPAIRSData::class,
        'tft_rated_mini_badges_ranked_tft_turbo' => TftRatedMiniBadgesRANKEDTFTTURBOData::class,
        'tft_rated_postgame_badges_ranked_tft_pairs' => TftRatedPostgameBadgesRANKEDTFTPAIRSData::class,
        'tft_rated_postgame_badges_ranked_tft_turbo' => TftRatedPostgameBadgesRANKEDTFTTURBOData::class,
        'star_shards_assets' => StarShardsAssetsData::class,
        'unreferenced_mageseeker_rewards' => UnreferencedMageseekerRewardsData::class,
    ];
}
