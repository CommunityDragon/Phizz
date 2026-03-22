<?php

namespace Phizz\CDragon;

use Illuminate\Support\Collection;
use Phizz\CDragon\Achievementtitles\Objects\AchievementtitleData;
use Phizz\CDragon\BotChallenges\Objects\BotChallengeData;
use Phizz\CDragon\Challenges\Objects\ChallengeData;
use Phizz\CDragon\Championperkstylemap\Objects\ChampionperkstylemapData;
use Phizz\CDragon\ChampionRuneRecommendations\Objects\ChampionRuneRecommendationData;
use Phizz\CDragon\Champions\Objects\ChampionData;
use Phizz\CDragon\ChampionSummary\Objects\ChampionSummaryData;
use Phizz\CDragon\CherryAugments\Objects\CherryAugmentData;
use Phizz\CDragon\CherryLobby\Objects\CherryLobbyData;
use Phizz\CDragon\ClashVo\Objects\ClashVoData;
use Phizz\CDragon\Companions\Objects\CompanionData;
use Phizz\CDragon\CsssheetTeamplanner\Objects\CsssheetTeamplannerData;
use Phizz\CDragon\DiscordStrings\Objects\DiscordStringData;
use Phizz\CDragon\EventHub\Objects\EventHubData;
use Phizz\CDragon\EventPasses\Objects\EventPassData;
use Phizz\CDragon\GameModeMutators\Objects\GameModeMutatorData;
use Phizz\CDragon\GenericAssets\Objects\GenericAssetData;
use Phizz\CDragon\Hovertips\Objects\HovertipData;
use Phizz\CDragon\Items\Objects\ItemData;
use Phizz\CDragon\Leaderboardconfiguration\Objects\LeaderboardconfigurationData;
use Phizz\CDragon\Lolcurrency\Objects\LolcurrencyData;
use Phizz\CDragon\Loleosrewards\Objects\LoleosrewardData;
use Phizz\CDragon\Lolinventorytype\Objects\LolinventorytypeData;
use Phizz\CDragon\Lolseasonassets\Objects\LolseasonassetData;
use Phizz\CDragon\Loot\Objects\LootData;
use Phizz\CDragon\Maps\Objects\MapData;
use Phizz\CDragon\MissionAssets\Objects\MissionAssetData;
use Phizz\CDragon\Nachobanners\Objects\NachobannerData;
use Phizz\CDragon\Nachorewards\Objects\NachorewardData;
use Phizz\CDragon\Nexusfinishers\Objects\NexusfinisherData;
use Phizz\CDragon\NumberFormattingData\Objects\NumberFormattingDatumData;
use Phizz\CDragon\Objectives\Objects\ObjectiveData;
use Phizz\CDragon\Opal\Objects\OpalData;
use Phizz\CDragon\Perks\Objects\PerkData;
use Phizz\CDragon\Perkstyles\Objects\PerkstyleData;
use Phizz\CDragon\ProfileIcons\Objects\ProfileIconData;
use Phizz\CDragon\Queues\Objects\QueueData;
use Phizz\CDragon\Regalia\Objects\RegaliumData;
use Phizz\CDragon\Rewards\Objects\RewardData;
use Phizz\CDragon\Settingstopersist\Objects\SettingstopersistData;
use Phizz\CDragon\Skinaugments\Objects\SkinaugmentData;
use Phizz\CDragon\Skinborders\Objects\SkinborderData;
use Phizz\CDragon\Skinlines\Objects\SkinlineData;
use Phizz\CDragon\Statstones\Objects\StatstoneData;
use Phizz\CDragon\StrawberryHub\Objects\StrawberryHubData;
use Phizz\CDragon\Stylesheet\Objects\StylesheetData;
use Phizz\CDragon\StylesheetTeamplanner\Objects\StylesheetTeamplannerData;
use Phizz\CDragon\SummonerBanners\Objects\SummonerBannerData;
use Phizz\CDragon\SummonerEmotes\Objects\SummonerEmoteData;
use Phizz\CDragon\SummonerIcons\Objects\SummonerIconData;
use Phizz\CDragon\SummonerIconSets\Objects\SummonerIconSetData;
use Phizz\CDragon\SummonerSpells\Objects\SummonerSpellData;
use Phizz\CDragon\SummonerTrophies\Objects\SummonerTrophyData;
use Phizz\CDragon\Universes\Objects\UniverseData;
use Phizz\CDragon\WardSkins\Objects\WardSkinData;
use Phizz\CDragon\WardSkinSets\Objects\WardSkinSetData;
use Phizz\Support\StaticApi;

class LolClient extends StaticApi
{
    /**
     * @return Collection<int, AchievementtitleData>
     */
    public function achievementTitles(): Collection
    {
        return $this->fetch(
            '/v1/achievementtitles.json',
            collectionType: AchievementtitleData::class,
        );
    }

    /**
     * @return Collection<int, BotChallengeData>|BotChallengeData
     */
    public function botChallenges(?int $id = null): Collection|BotChallengeData
    {
        return $this->fetch(
            '/v1/bot-challenges.json',
            collectionType: BotChallengeData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, ChallengeData>
     */
    public function challenges(): Collection
    {
        return $this->fetch(
            '/v1/challenges.json',
            collectionType: ChallengeData::class,
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
     * @return Collection<int, ChampionSummaryData>|ChampionSummaryData
     */
    public function championSummary(?int $id = null): Collection|ChampionSummaryData
    {
        return $this->fetch(
            '/v1/champion-summary.json',
            collectionType: ChampionSummaryData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, ChampionperkstylemapData>
     */
    public function championPerkStyleMap(): Collection
    {
        return $this->fetch(
            '/v1/championperkstylemap.json',
            collectionType: ChampionperkstylemapData::class,
        );
    }

    /**
     * @return Collection<int, CherryAugmentData>|CherryAugmentData
     */
    public function cherryAugments(?int $id = null): Collection|CherryAugmentData
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

    /**
     * @return Collection<int, ClashVoData>
     */
    public function clashVo(): Collection
    {
        return $this->fetch(
            '/v1/clash-vo.json',
            collectionType: ClashVoData::class,
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

    /**
     * @return Collection<int, DiscordStringData>
     */
    public function discordStrings(): Collection
    {
        return $this->fetch(
            '/v1/discord_strings.json',
            collectionType: DiscordStringData::class,
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

    /**
     * @return Collection<int, GenericAssetData>
     */
    public function genericAssets(): Collection
    {
        return $this->fetch(
            '/v1/generic-assets.json',
            collectionType: GenericAssetData::class,
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
     * @return Collection<int, ItemData>|ItemData
     */
    public function items(?int $id = null): Collection|ItemData
    {
        return $this->fetch(
            '/v1/items.json',
            collectionType: ItemData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, LeaderboardconfigurationData>
     */
    public function leaderboardConfiguration(): Collection
    {
        return $this->fetch(
            '/v1/leaderboardconfiguration.json',
            collectionType: LeaderboardconfigurationData::class,
        );
    }

    /**
     * @return Collection<int, LolcurrencyData>
     */
    public function currency(): Collection
    {
        return $this->fetch(
            '/v1/lolcurrency.json',
            collectionType: LolcurrencyData::class,
        );
    }

    /**
     * @return Collection<int, LoleosrewardData>
     */
    public function eosRewards(): Collection
    {
        return $this->fetch(
            '/v1/loleosrewards.json',
            collectionType: LoleosrewardData::class,
        );
    }

    /**
     * @return Collection<int, LolinventorytypeData>
     */
    public function inventoryType(): Collection
    {
        return $this->fetch(
            '/v1/lolinventorytype.json',
            collectionType: LolinventorytypeData::class,
        );
    }

    /**
     * @return Collection<int, LolseasonassetData>
     */
    public function seasonAssets(): Collection
    {
        return $this->fetch(
            '/v1/lolseasonassets.json',
            collectionType: LolseasonassetData::class,
        );
    }

    /**
     * @return Collection<int, LootData>
     */
    public function loot(): Collection
    {
        return $this->fetch(
            '/v1/loot.json',
            collectionType: LootData::class,
        );
    }

    /**
     * @return Collection<int, MapData>|MapData
     */
    public function maps(?int $id = null): Collection|MapData
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
     * @return Collection<int, NachobannerData>
     */
    public function nachoBanners(): Collection
    {
        return $this->fetch(
            '/v1/nachobanners.json',
            collectionType: NachobannerData::class,
        );
    }

    /**
     * @return Collection<int, NachorewardData>
     */
    public function nachoRewards(): Collection
    {
        return $this->fetch(
            '/v1/nachorewards.json',
            collectionType: NachorewardData::class,
        );
    }

    /**
     * @return Collection<int, NexusfinisherData>
     */
    public function nexusFinishers(): Collection
    {
        return $this->fetch(
            '/v1/nexusfinishers.json',
            collectionType: NexusfinisherData::class,
        );
    }

    /**
     * @return Collection<int, NumberFormattingDatumData>
     */
    public function numberFormattingData(): Collection
    {
        return $this->fetch(
            '/v1/number-formatting-data.json',
            collectionType: NumberFormattingDatumData::class,
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
     * @return Collection<int, PerkData>|PerkData
     */
    public function perks(?int $id = null): Collection|PerkData
    {
        return $this->fetch(
            '/v1/perks.json',
            collectionType: PerkData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, PerkstyleData>
     */
    public function perkstyles(): Collection
    {
        return $this->fetch(
            '/v1/perkstyles.json',
            collectionType: PerkstyleData::class,
        );
    }

    /**
     * @return Collection<int, ProfileIconData>|ProfileIconData
     */
    public function profileIcons(?int $id = null): Collection|ProfileIconData
    {
        return $this->fetch(
            '/v1/profile-icons.json',
            collectionType: ProfileIconData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, QueueData>|QueueData
     */
    public function queues(?int $id = null): Collection|QueueData
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

    /**
     * @return Collection<int, SettingstopersistData>
     */
    public function settingsToPersist(): Collection
    {
        return $this->fetch(
            '/v1/settingstopersist.json',
            collectionType: SettingstopersistData::class,
        );
    }

    /**
     * @return Collection<int, SkinaugmentData>
     */
    public function skinAugments(): Collection
    {
        return $this->fetch(
            '/v1/skinaugments.json',
            collectionType: SkinaugmentData::class,
        );
    }

    /**
     * @return Collection<int, SkinborderData>
     */
    public function skinBorders(): Collection
    {
        return $this->fetch(
            '/v1/skinborders.json',
            collectionType: SkinborderData::class,
        );
    }

    /**
     * @return Collection<int, SkinlineData>|SkinlineData
     */
    public function skinLines(?int $id = null): Collection|SkinlineData
    {
        return $this->fetch(
            '/v1/skinlines.json',
            collectionType: SkinlineData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, StatstoneData>
     */
    public function statStones(): Collection
    {
        return $this->fetch(
            '/v1/statstones.json',
            collectionType: StatstoneData::class,
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

    /**
     * @return Collection<int, StylesheetTeamplannerData>
     */
    public function stylesheetTeamplanner(): Collection
    {
        return $this->fetch(
            '/v1/stylesheet-teamplanner.json',
            collectionType: StylesheetTeamplannerData::class,
        );
    }

    /**
     * @return Collection<int, StylesheetData>
     */
    public function stylesheet(): Collection
    {
        return $this->fetch(
            '/v1/stylesheet.json',
            collectionType: StylesheetData::class,
        );
    }

    /**
     * @return Collection<int, SummonerBannerData>
     */
    public function summonerBanners(): Collection
    {
        return $this->fetch(
            '/v1/summoner-banners.json',
            collectionType: SummonerBannerData::class,
        );
    }

    /**
     * @return Collection<int, SummonerEmoteData>|SummonerEmoteData
     */
    public function summonerEmotes(?int $id = null): Collection|SummonerEmoteData
    {
        return $this->fetch(
            '/v1/summoner-emotes.json',
            collectionType: SummonerEmoteData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerIconSetData>|SummonerIconSetData
     */
    public function summonerIconSets(?int $id = null): Collection|SummonerIconSetData
    {
        return $this->fetch(
            '/v1/summoner-icon-sets.json',
            collectionType: SummonerIconSetData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerIconData>|SummonerIconData
     */
    public function summonerIcons(?int $id = null): Collection|SummonerIconData
    {
        return $this->fetch(
            '/v1/summoner-icons.json',
            collectionType: SummonerIconData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerSpellData>|SummonerSpellData
     */
    public function summonerSpells(?int $id = null): Collection|SummonerSpellData
    {
        return $this->fetch(
            '/v1/summoner-spells.json',
            collectionType: SummonerSpellData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, SummonerTrophyData>
     */
    public function summonerTrophies(): Collection
    {
        return $this->fetch(
            '/v1/summoner-trophies.json',
            collectionType: SummonerTrophyData::class,
        );
    }

    /**
     * @return Collection<int, UniverseData>|UniverseData
     */
    public function universes(?int $id = null): Collection|UniverseData
    {
        return $this->fetch(
            '/v1/universes.json',
            collectionType: UniverseData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, WardSkinSetData>|WardSkinSetData
     */
    public function wardSkinSets(?int $id = null): Collection|WardSkinSetData
    {
        return $this->fetch(
            '/v1/ward-skin-sets.json',
            collectionType: WardSkinSetData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, WardSkinData>|WardSkinData
     */
    public function wardSkins(?int $id = null): Collection|WardSkinData
    {
        return $this->fetch(
            '/v1/ward-skins.json',
            collectionType: WardSkinData::class,
            idField: 'id',
            id: $id,
        );
    }

    public function champions(int $id): ChampionData
    {
        return $this->fetch(
            "/v1/champions/{$id}.json",
            returnType: ChampionData::class,
        );
    }
}
