<?php

namespace Phizz\Assets\Lol\Objectives\Objects;

use Phizz\Support\StaticData;

/**
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardValueTFTPassRewardWalletData $tftPassRewardWallet
 * @property-read ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardValueTFTPassRewardCatalogTacticianData $tftPassRewardCatalogTactician
 */
class ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardValueData extends StaticData
{
    protected array $objects = [
        'tft_pass_reward_wallet' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardValueTFTPassRewardWalletData::class,
        'tft_pass_reward_catalog_tactician' => ObjectivesGroupObjectivesCategoryTFTPassDataTFTPassDataMilestoneValueTFTPassMilestoneDataRewardValueTFTPassRewardCatalogTacticianData::class,
    ];
}
