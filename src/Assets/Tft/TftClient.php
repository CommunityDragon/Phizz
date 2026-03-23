<?php

namespace Phizz\Assets\Tft;

use Illuminate\Support\Collection;
use Phizz\Assets\Tft\CapMissionCollection\Objects\CapMissionCollectionData;
use Phizz\Assets\Tft\Champions\Objects\ChampionData;
use Phizz\Assets\Tft\ChampionsTeamplanner\Objects\ChampionsTeamplannerData;
use Phizz\Assets\Tft\ChemtechStoreData\Objects\ChemtechStoreDatumData;
use Phizz\Assets\Tft\ContentData\Objects\ContentDatumData;
use Phizz\Assets\Tft\CosmeticsDefault\Objects\CosmeticsDefaultData;
use Phizz\Assets\Tft\DamageSkins\Objects\DamageSkinData;
use Phizz\Assets\Tft\DisplayTags\Objects\DisplayTagData;
use Phizz\Assets\Tft\GameVariations\Objects\GameVariationData;
use Phizz\Assets\Tft\Items\Objects\ItemData;
use Phizz\Assets\Tft\MapSkins\Objects\MapSkinData;
use Phizz\Assets\Tft\PassAssets\Objects\PassAssetData;
use Phizz\Assets\Tft\PassWelcomeData\Objects\PassWelcomeDatumData;
use Phizz\Assets\Tft\Playbooks\Objects\PlaybookData;
use Phizz\Assets\Tft\RegionPortals\Objects\RegionPortalData;
use Phizz\Assets\Tft\RotationalShopItemData\Objects\RotationalShopItemDatumData;
use Phizz\Assets\Tft\Sets\Objects\SetData;
use Phizz\Assets\Tft\SkillTree\Objects\SkillTreeData;
use Phizz\Assets\Tft\Traits\Objects\TraitData;
use Phizz\Assets\Tft\TrovesBannerRewards\Objects\TrovesBannerRewardData;
use Phizz\Assets\Tft\TrovesBanners\Objects\TrovesBannerData;
use Phizz\Assets\Tft\TrovesTablesNames\Objects\TrovesTablesNameData;
use Phizz\Assets\Tft\UxTunables\Objects\UxTunableData;
use Phizz\Assets\Tft\ZoomSkins\Objects\ZoomSkinData;
use Phizz\Support\StaticApi;

class TftClient extends StaticApi
{
    /**
     * @return Collection<int, CapMissionCollectionData>
     */
    public function capMissionCollection(): Collection
    {
        return $this->fetch(
            '/v1/tftcapmissioncollection.json',
            collectionType: CapMissionCollectionData::class,
        );
    }

    public function championsTeamplanner(): ?ChampionsTeamplannerData
    {
        return $this->fetch(
            '/v1/tftchampions-teamplanner.json',
            returnType: ChampionsTeamplannerData::class,
        );
    }

    /**
     * @return Collection<int, ChampionData>
     */
    public function champions(): Collection
    {
        return $this->fetch(
            '/v1/tftchampions.json',
            collectionType: ChampionData::class,
        );
    }

    /**
     * @return Collection<int, ChemtechStoreDatumData>
     */
    public function chemtechStoreData(): Collection
    {
        return $this->fetch(
            '/v1/tftchemtechstoredata.json',
            collectionType: ChemtechStoreDatumData::class,
        );
    }

    /**
     * @return Collection<int, ContentDatumData>
     */
    public function contentData(): Collection
    {
        return $this->fetch(
            '/v1/tftcontentdata.json',
            collectionType: ContentDatumData::class,
        );
    }

    public function cosmeticsDefault(): ?CosmeticsDefaultData
    {
        return $this->fetch(
            '/v1/tftcosmeticsdefault.json',
            returnType: CosmeticsDefaultData::class,
        );
    }

    /**
     * @return Collection<int, DamageSkinData>
     */
    public function damageSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftdamageskins.json',
            collectionType: DamageSkinData::class,
        );
    }

    /**
     * @return Collection<int, DisplayTagData>
     */
    public function displayTags(): Collection
    {
        return $this->fetch(
            '/v1/tftdisplaytags.json',
            collectionType: DisplayTagData::class,
        );
    }

    /**
     * @return Collection<int, GameVariationData>
     */
    public function gameVariations(): Collection
    {
        return $this->fetch(
            '/v1/tftgamevariations.json',
            collectionType: GameVariationData::class,
        );
    }

    /**
     * @return Collection<int, ItemData>|ItemData|null
     */
    public function items(?int $id = null): Collection|ItemData|null
    {
        return $this->fetch(
            '/v1/tftitems.json',
            collectionType: ItemData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, MapSkinData>
     */
    public function mapSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftmapskins.json',
            collectionType: MapSkinData::class,
        );
    }

    /**
     * @return Collection<int, PassAssetData>
     */
    public function passAssets(): Collection
    {
        return $this->fetch(
            '/v1/tftpass-assets.json',
            collectionType: PassAssetData::class,
        );
    }

    public function passWelcomeData(): ?PassWelcomeDatumData
    {
        return $this->fetch(
            '/v1/tftpasswelcomedata.json',
            returnType: PassWelcomeDatumData::class,
        );
    }

    /**
     * @return Collection<int, PlaybookData>
     */
    public function playbooks(): Collection
    {
        return $this->fetch(
            '/v1/tftplaybooks.json',
            collectionType: PlaybookData::class,
        );
    }

    /**
     * @return Collection<int, RegionPortalData>
     */
    public function regionPortals(): Collection
    {
        return $this->fetch(
            '/v1/tftregionportals.json',
            collectionType: RegionPortalData::class,
        );
    }

    /**
     * @return Collection<int, RotationalShopItemDatumData>
     */
    public function rotationalShopItemData(): Collection
    {
        return $this->fetch(
            '/v1/tftrotationalshopitemdata.json',
            collectionType: RotationalShopItemDatumData::class,
        );
    }

    public function sets(): ?SetData
    {
        return $this->fetch(
            '/v1/tftsets.json',
            returnType: SetData::class,
        );
    }

    /**
     * @return Collection<int, SkillTreeData>
     */
    public function skillTree(): Collection
    {
        return $this->fetch(
            '/v1/tftskilltree.json',
            collectionType: SkillTreeData::class,
        );
    }

    /**
     * @return Collection<int, TraitData>
     */
    public function traits(): Collection
    {
        return $this->fetch(
            '/v1/tfttraits.json',
            collectionType: TraitData::class,
        );
    }

    /**
     * @return Collection<int, TrovesBannerRewardData>
     */
    public function trovesBannerRewards(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovesbannerrewards.json',
            collectionType: TrovesBannerRewardData::class,
        );
    }

    /**
     * @return Collection<int, TrovesBannerData>
     */
    public function trovesBanners(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovesbanners.json',
            collectionType: TrovesBannerData::class,
        );
    }

    /**
     * @return Collection<int, TrovesTablesNameData>
     */
    public function trovesTablesNames(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovestablesnames.json',
            collectionType: TrovesTablesNameData::class,
        );
    }

    /**
     * @return Collection<int, UxTunableData>
     */
    public function uxTunables(): Collection
    {
        return $this->fetch(
            '/v1/tftuxtunables.json',
            collectionType: UxTunableData::class,
        );
    }

    /**
     * @return Collection<int, ZoomSkinData>
     */
    public function zoomSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftzoomskins.json',
            collectionType: ZoomSkinData::class,
        );
    }
}
