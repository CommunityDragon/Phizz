<?php

namespace Phizz\Assets\Lol;

use Illuminate\Support\Collection;
use Phizz\Assets\Lol\AchievementTitles\Objects\AchievementTitleData;
use Phizz\Assets\Lol\BotChallenges\Objects\BotChallengeData;
use Phizz\Assets\Lol\Challenges\Objects\ChallengeData;
use Phizz\Assets\Lol\ChampionPerkStyleMap\Objects\ChampionPerkStyleMapData;
use Phizz\Assets\Lol\ChampionRuneRecommendations\Objects\ChampionRuneRecommendationData;
use Phizz\Assets\Lol\Champions\Objects\ChampionData;
use Phizz\Assets\Lol\ChampionSummary\Objects\ChampionSummaryData;
use Phizz\Assets\Lol\CherryAugments\Objects\CherryAugmentData;
use Phizz\Assets\Lol\CherryLobby\Objects\CherryLobbyData;
use Phizz\Assets\Lol\ClashVo\Objects\ClashVoData;
use Phizz\Assets\Lol\Companions\Objects\CompanionData;
use Phizz\Assets\Lol\CsssheetTeamplanner\Objects\CsssheetTeamplannerData;
use Phizz\Assets\Lol\Currency\Objects\CurrencyData;
use Phizz\Assets\Lol\DiscordStrings\Objects\DiscordStringData;
use Phizz\Assets\Lol\EosRewards\Objects\EosRewardData;
use Phizz\Assets\Lol\EventHub\Objects\EventHubData;
use Phizz\Assets\Lol\EventPasses\Objects\EventPassData;
use Phizz\Assets\Lol\GameModeMutators\Objects\GameModeMutatorData;
use Phizz\Assets\Lol\GenericAssets\Objects\GenericAssetData;
use Phizz\Assets\Lol\Hovertips\Objects\HovertipData;
use Phizz\Assets\Lol\InventoryType\Objects\InventoryTypeData;
use Phizz\Assets\Lol\Items\Objects\ItemData;
use Phizz\Assets\Lol\LeaderboardConfiguration\Objects\LeaderboardConfigurationData;
use Phizz\Assets\Lol\Loot\Objects\LootData;
use Phizz\Assets\Lol\Maps\Objects\MapData;
use Phizz\Assets\Lol\MissionAssets\Objects\MissionAssetData;
use Phizz\Assets\Lol\NachoBanners\Objects\NachoBannerData;
use Phizz\Assets\Lol\NachoRewards\Objects\NachoRewardData;
use Phizz\Assets\Lol\NexusFinishers\Objects\NexusFinisherData;
use Phizz\Assets\Lol\NumberFormattingData\Objects\NumberFormattingDatumData;
use Phizz\Assets\Lol\Objectives\Objects\ObjectiveData;
use Phizz\Assets\Lol\Opal\Objects\OpalData;
use Phizz\Assets\Lol\Perks\Objects\PerkData;
use Phizz\Assets\Lol\Perkstyles\Objects\PerkstyleData;
use Phizz\Assets\Lol\ProfileIcons\Objects\ProfileIconData;
use Phizz\Assets\Lol\Queues\Objects\QueueData;
use Phizz\Assets\Lol\Regalia\Objects\RegaliumData;
use Phizz\Assets\Lol\Rewards\Objects\RewardData;
use Phizz\Assets\Lol\SeasonAssets\Objects\SeasonAssetData;
use Phizz\Assets\Lol\SettingsToPersist\Objects\SettingsToPersistData;
use Phizz\Assets\Lol\SkinAugments\Objects\SkinAugmentData;
use Phizz\Assets\Lol\SkinBorders\Objects\SkinBorderData;
use Phizz\Assets\Lol\SkinLines\Objects\SkinLineData;
use Phizz\Assets\Lol\Skins\Objects\SkinData;
use Phizz\Assets\Lol\StatStones\Objects\StatStoneData;
use Phizz\Assets\Lol\StrawberryHub\Objects\StrawberryHubData;
use Phizz\Assets\Lol\Stylesheet\Objects\StylesheetData;
use Phizz\Assets\Lol\StylesheetTeamplanner\Objects\StylesheetTeamplannerData;
use Phizz\Assets\Lol\SummonerBanners\Objects\SummonerBannerData;
use Phizz\Assets\Lol\SummonerEmotes\Objects\SummonerEmoteData;
use Phizz\Assets\Lol\SummonerIcons\Objects\SummonerIconData;
use Phizz\Assets\Lol\SummonerIconSets\Objects\SummonerIconSetData;
use Phizz\Assets\Lol\SummonerSpells\Objects\SummonerSpellData;
use Phizz\Assets\Lol\SummonerTrophies\Objects\SummonerTrophyData;
use Phizz\Assets\Lol\Universes\Objects\UniverseData;
use Phizz\Assets\Lol\WardSkins\Objects\WardSkinData;
use Phizz\Assets\Lol\WardSkinSets\Objects\WardSkinSetData;
use Phizz\Support\StaticApi;

class LolClient extends StaticApi
{
    /**
     * @return Collection<int, AchievementTitleData>
     */
    public function achievementTitles(): Collection
    {
        return $this->fetch(
            '/v1/achievementtitles.json',
            collectionType: AchievementTitleData::class,
        );
    }

    /**
     * @return Collection<int, BotChallengeData>|BotChallengeData|null
     */
    public function botChallenges(?int $id = null): Collection|BotChallengeData|null
    {
        return $this->fetch(
            '/v1/bot-challenges.json',
            collectionType: BotChallengeData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function challenges(): ?ChallengeData
    {
        return $this->fetch(
            '/v1/challenges.json',
            returnType: ChallengeData::class,
        );
    }

    /**
     * @return Collection<int, ChampionRuneRecommendationData>
     */
    public function championRuneRecommendations(): Collection
    {
        return $this->fetch(
            '/v1/champion-rune-recommendations.json',
            collectionType: ChampionRuneRecommendationData::class,
        );
    }

    /**
     * @return Collection<int, ChampionSummaryData>|ChampionSummaryData|null
     */
    public function championSummary(?int $id = null): Collection|ChampionSummaryData|null
    {
        return $this->fetch(
            '/v1/champion-summary.json',
            collectionType: ChampionSummaryData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, ChampionPerkStyleMapData>
     */
    public function championPerkStyleMap(): Collection
    {
        return $this->fetch(
            '/v1/championperkstylemap.json',
            collectionType: ChampionPerkStyleMapData::class,
        );
    }

    /**
     * @return Collection<int, CherryAugmentData>|CherryAugmentData|null
     */
    public function cherryAugments(?int $id = null): Collection|CherryAugmentData|null
    {
        return $this->fetch(
            '/v1/cherry-augments.json',
            collectionType: CherryAugmentData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, CherryLobbyData>
     */
    public function cherryLobby(): Collection
    {
        return $this->fetch(
            '/v1/cherry-lobby.json',
            collectionType: CherryLobbyData::class,
        );
    }

    public function clashVo(): ?ClashVoData
    {
        return $this->fetch(
            '/v1/clash-vo.json',
            returnType: ClashVoData::class,
        );
    }

    /**
     * @return Collection<int, CompanionData>
     */
    public function companions(): Collection
    {
        return $this->fetch(
            '/v1/companions.json',
            collectionType: CompanionData::class,
        );
    }

    /**
     * @return Collection<int, CsssheetTeamplannerData>
     */
    public function csssheetTeamplanner(): Collection
    {
        return $this->fetch(
            '/v1/csssheet-teamplanner.json',
            collectionType: CsssheetTeamplannerData::class,
        );
    }

    public function discordStrings(): ?DiscordStringData
    {
        return $this->fetch(
            '/v1/discord_strings.json',
            returnType: DiscordStringData::class,
        );
    }

    /**
     * @return Collection<int, EventHubData>
     */
    public function eventHub(): Collection
    {
        return $this->fetch(
            '/v1/event-hub.json',
            collectionType: EventHubData::class,
        );
    }

    /**
     * @return Collection<int, EventPassData>
     */
    public function eventPasses(): Collection
    {
        return $this->fetch(
            '/v1/event-passes.json',
            collectionType: EventPassData::class,
        );
    }

    /**
     * @return Collection<int, GameModeMutatorData>
     */
    public function gameModeMutators(): Collection
    {
        return $this->fetch(
            '/v1/game-mode-mutators.json',
            collectionType: GameModeMutatorData::class,
        );
    }

    public function genericAssets(): ?GenericAssetData
    {
        return $this->fetch(
            '/v1/generic-assets.json',
            returnType: GenericAssetData::class,
        );
    }

    /**
     * @return Collection<int, HovertipData>
     */
    public function hovertips(): Collection
    {
        return $this->fetch(
            '/v1/hovertips.json',
            collectionType: HovertipData::class,
        );
    }

    /**
     * @return Collection<int, ItemData>|ItemData|null
     */
    public function items(?int $id = null): Collection|ItemData|null
    {
        return $this->fetch(
            '/v1/items.json',
            collectionType: ItemData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, LeaderboardConfigurationData>
     */
    public function leaderboardConfiguration(): Collection
    {
        return $this->fetch(
            '/v1/leaderboardconfiguration.json',
            collectionType: LeaderboardConfigurationData::class,
        );
    }

    /**
     * @return Collection<int, CurrencyData>
     */
    public function currency(): Collection
    {
        return $this->fetch(
            '/v1/lolcurrency.json',
            collectionType: CurrencyData::class,
        );
    }

    /**
     * @return Collection<int, EosRewardData>
     */
    public function eosRewards(): Collection
    {
        return $this->fetch(
            '/v1/loleosrewards.json',
            collectionType: EosRewardData::class,
        );
    }

    /**
     * @return Collection<int, InventoryTypeData>
     */
    public function inventoryType(): Collection
    {
        return $this->fetch(
            '/v1/lolinventorytype.json',
            collectionType: InventoryTypeData::class,
        );
    }

    /**
     * @return Collection<int, SeasonAssetData>
     */
    public function seasonAssets(): Collection
    {
        return $this->fetch(
            '/v1/lolseasonassets.json',
            collectionType: SeasonAssetData::class,
        );
    }

    public function loot(): ?LootData
    {
        return $this->fetch(
            '/v1/loot.json',
            returnType: LootData::class,
        );
    }

    /**
     * @return Collection<int, MapData>|MapData|null
     */
    public function maps(?int $id = null): Collection|MapData|null
    {
        return $this->fetch(
            '/v1/maps.json',
            collectionType: MapData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, MissionAssetData>
     */
    public function missionAssets(): Collection
    {
        return $this->fetch(
            '/v1/mission-assets.json',
            collectionType: MissionAssetData::class,
        );
    }

    /**
     * @return Collection<int, NachoBannerData>
     */
    public function nachoBanners(): Collection
    {
        return $this->fetch(
            '/v1/nachobanners.json',
            collectionType: NachoBannerData::class,
        );
    }

    /**
     * @return Collection<int, NachoRewardData>
     */
    public function nachoRewards(): Collection
    {
        return $this->fetch(
            '/v1/nachorewards.json',
            collectionType: NachoRewardData::class,
        );
    }

    /**
     * @return Collection<int, NexusFinisherData>
     */
    public function nexusFinishers(): Collection
    {
        return $this->fetch(
            '/v1/nexusfinishers.json',
            collectionType: NexusFinisherData::class,
        );
    }

    public function numberFormattingData(): ?NumberFormattingDatumData
    {
        return $this->fetch(
            '/v1/number-formatting-data.json',
            returnType: NumberFormattingDatumData::class,
        );
    }

    /**
     * @return Collection<int, ObjectiveData>
     */
    public function objectives(): Collection
    {
        return $this->fetch(
            '/v1/objectives.json',
            collectionType: ObjectiveData::class,
        );
    }

    /**
     * @return Collection<int, OpalData>
     */
    public function opal(): Collection
    {
        return $this->fetch(
            '/v1/opal.json',
            collectionType: OpalData::class,
        );
    }

    /**
     * @return Collection<int, PerkData>|PerkData|null
     */
    public function perks(?int $id = null): Collection|PerkData|null
    {
        return $this->fetch(
            '/v1/perks.json',
            collectionType: PerkData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function perkstyles(): ?PerkstyleData
    {
        return $this->fetch(
            '/v1/perkstyles.json',
            returnType: PerkstyleData::class,
        );
    }

    /**
     * @return Collection<int, ProfileIconData>|ProfileIconData|null
     */
    public function profileIcons(?int $id = null): Collection|ProfileIconData|null
    {
        return $this->fetch(
            '/v1/profile-icons.json',
            collectionType: ProfileIconData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, QueueData>|QueueData|null
     */
    public function queues(?int $id = null): Collection|QueueData|null
    {
        return $this->fetch(
            '/v1/queues.json',
            collectionType: QueueData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, RegaliumData>
     */
    public function regalia(): Collection
    {
        return $this->fetch(
            '/v1/regalia.json',
            collectionType: RegaliumData::class,
        );
    }

    /**
     * @return Collection<int, RewardData>
     */
    public function rewards(): Collection
    {
        return $this->fetch(
            '/v1/rewards.json',
            collectionType: RewardData::class,
        );
    }

    public function settingsToPersist(): ?SettingsToPersistData
    {
        return $this->fetch(
            '/v1/settingstopersist.json',
            returnType: SettingsToPersistData::class,
        );
    }

    /**
     * @return Collection<int, SkinAugmentData>
     */
    public function skinAugments(): Collection
    {
        return $this->fetch(
            '/v1/skinaugments.json',
            collectionType: SkinAugmentData::class,
        );
    }

    /**
     * @return Collection<int, SkinBorderData>
     */
    public function skinBorders(): Collection
    {
        return $this->fetch(
            '/v1/skinborders.json',
            collectionType: SkinBorderData::class,
        );
    }

    /**
     * @return Collection<int, SkinLineData>|SkinLineData|null
     */
    public function skinLines(?int $id = null): Collection|SkinLineData|null
    {
        return $this->fetch(
            '/v1/skinlines.json',
            collectionType: SkinLineData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SkinData>|SkinData|null
     */
    public function skins(?int $id = null): Collection|SkinData|null
    {
        return $this->fetch(
            '/v1/skins.json',
            collectionType: SkinData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function statStones(): ?StatStoneData
    {
        return $this->fetch(
            '/v1/statstones.json',
            returnType: StatStoneData::class,
        );
    }

    /**
     * @return Collection<int, StrawberryHubData>
     */
    public function strawberryHub(): Collection
    {
        return $this->fetch(
            '/v1/strawberry-hub.json',
            collectionType: StrawberryHubData::class,
        );
    }

    public function stylesheetTeamplanner(): ?StylesheetTeamplannerData
    {
        return $this->fetch(
            '/v1/stylesheet-teamplanner.json',
            returnType: StylesheetTeamplannerData::class,
        );
    }

    public function stylesheet(): ?StylesheetData
    {
        return $this->fetch(
            '/v1/stylesheet.json',
            returnType: StylesheetData::class,
        );
    }

    public function summonerBanners(): ?SummonerBannerData
    {
        return $this->fetch(
            '/v1/summoner-banners.json',
            returnType: SummonerBannerData::class,
        );
    }

    /**
     * @return Collection<int, SummonerEmoteData>|SummonerEmoteData|null
     */
    public function summonerEmotes(?int $id = null): Collection|SummonerEmoteData|null
    {
        return $this->fetch(
            '/v1/summoner-emotes.json',
            collectionType: SummonerEmoteData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerIconSetData>|SummonerIconSetData|null
     */
    public function summonerIconSets(?int $id = null): Collection|SummonerIconSetData|null
    {
        return $this->fetch(
            '/v1/summoner-icon-sets.json',
            collectionType: SummonerIconSetData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerIconData>|SummonerIconData|null
     */
    public function summonerIcons(?int $id = null): Collection|SummonerIconData|null
    {
        return $this->fetch(
            '/v1/summoner-icons.json',
            collectionType: SummonerIconData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerSpellData>|SummonerSpellData|null
     */
    public function summonerSpells(?int $id = null): Collection|SummonerSpellData|null
    {
        return $this->fetch(
            '/v1/summoner-spells.json',
            collectionType: SummonerSpellData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function summonerTrophies(): ?SummonerTrophyData
    {
        return $this->fetch(
            '/v1/summoner-trophies.json',
            returnType: SummonerTrophyData::class,
        );
    }

    /**
     * @return Collection<int, UniverseData>|UniverseData|null
     */
    public function universes(?int $id = null): Collection|UniverseData|null
    {
        return $this->fetch(
            '/v1/universes.json',
            collectionType: UniverseData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, WardSkinSetData>|WardSkinSetData|null
     */
    public function wardSkinSets(?int $id = null): Collection|WardSkinSetData|null
    {
        return $this->fetch(
            '/v1/ward-skin-sets.json',
            collectionType: WardSkinSetData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, WardSkinData>|WardSkinData|null
     */
    public function wardSkins(?int $id = null): Collection|WardSkinData|null
    {
        return $this->fetch(
            '/v1/ward-skins.json',
            collectionType: WardSkinData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function champions(int $id): ?ChampionData
    {
        return $this->fetch(
            "/v1/champions/{$id}.json",
            returnType: ChampionData::class,
        );
    }
}
