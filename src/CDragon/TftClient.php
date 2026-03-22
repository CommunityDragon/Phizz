<?php

namespace Phizz\CDragon;

use Illuminate\Support\Collection;
use Phizz\CDragon\Tftcapmissioncollection\Objects\TftcapmissioncollectionData;
use Phizz\CDragon\Tftchampions\Objects\TftchampionData;
use Phizz\CDragon\TftchampionsTeamplanner\Objects\TftchampionsTeamplannerData;
use Phizz\CDragon\Tftchemtechstoredata\Objects\TftchemtechstoredatumData;
use Phizz\CDragon\Tftcontentdata\Objects\TftcontentdatumData;
use Phizz\CDragon\Tftcosmeticsdefault\Objects\TftcosmeticsdefaultData;
use Phizz\CDragon\Tftdamageskins\Objects\TftdamageskinData;
use Phizz\CDragon\Tftdisplaytags\Objects\TftdisplaytagData;
use Phizz\CDragon\Tftgamevariations\Objects\TftgamevariationData;
use Phizz\CDragon\Tftitems\Objects\TftitemData;
use Phizz\CDragon\Tftmapskins\Objects\TftmapskinData;
use Phizz\CDragon\TftpassAssets\Objects\TftpassAssetData;
use Phizz\CDragon\Tftpasswelcomedata\Objects\TftpasswelcomedatumData;
use Phizz\CDragon\Tftplaybooks\Objects\TftplaybookData;
use Phizz\CDragon\Tftregionportals\Objects\TftregionportalData;
use Phizz\CDragon\Tftrotationalshopitemdata\Objects\TftrotationalshopitemdatumData;
use Phizz\CDragon\Tftsets\Objects\TftsetData;
use Phizz\CDragon\Tftskilltree\Objects\TftskilltreeData;
use Phizz\CDragon\Tfttraits\Objects\TfttraitData;
use Phizz\CDragon\Tfttrovesbannerrewards\Objects\TfttrovesbannerrewardData;
use Phizz\CDragon\Tfttrovesbanners\Objects\TfttrovesbannerData;
use Phizz\CDragon\Tfttrovestablesnames\Objects\TfttrovestablesnameData;
use Phizz\CDragon\Tftuxtunables\Objects\TftuxtunableData;
use Phizz\CDragon\Tftzoomskins\Objects\TftzoomskinData;
use Phizz\Support\StaticApi;

class TftClient extends StaticApi
{
    /**
     * @return Collection<int, TftcapmissioncollectionData>
     */
    public function capMissionCollection(): Collection
    {
        return $this->fetch(
            '/v1/tftcapmissioncollection.json',
            collectionType: TftcapmissioncollectionData::class,
        );
    }

    /**
     * @return Collection<int, TftchampionsTeamplannerData>
     */
    public function championsTeamplanner(): Collection
    {
        return $this->fetch(
            '/v1/tftchampions-teamplanner.json',
            collectionType: TftchampionsTeamplannerData::class,
        );
    }

    /**
     * @return Collection<int, TftchampionData>
     */
    public function champions(): Collection
    {
        return $this->fetch(
            '/v1/tftchampions.json',
            collectionType: TftchampionData::class,
        );
    }

    /**
     * @return Collection<int, TftchemtechstoredatumData>
     */
    public function chemtechStoreData(): Collection
    {
        return $this->fetch(
            '/v1/tftchemtechstoredata.json',
            collectionType: TftchemtechstoredatumData::class,
        );
    }

    /**
     * @return Collection<int, TftcontentdatumData>
     */
    public function contentData(): Collection
    {
        return $this->fetch(
            '/v1/tftcontentdata.json',
            collectionType: TftcontentdatumData::class,
        );
    }

    /**
     * @return Collection<int, TftcosmeticsdefaultData>
     */
    public function cosmeticsDefault(): Collection
    {
        return $this->fetch(
            '/v1/tftcosmeticsdefault.json',
            collectionType: TftcosmeticsdefaultData::class,
        );
    }

    /**
     * @return Collection<int, TftdamageskinData>
     */
    public function damageSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftdamageskins.json',
            collectionType: TftdamageskinData::class,
        );
    }

    /**
     * @return Collection<int, TftdisplaytagData>
     */
    public function displayTags(): Collection
    {
        return $this->fetch(
            '/v1/tftdisplaytags.json',
            collectionType: TftdisplaytagData::class,
        );
    }

    /**
     * @return Collection<int, TftgamevariationData>
     */
    public function gameVariations(): Collection
    {
        return $this->fetch(
            '/v1/tftgamevariations.json',
            collectionType: TftgamevariationData::class,
        );
    }

    /**
     * @return Collection<int, TftitemData>|TftitemData
     */
    public function items(?int $id = null): Collection|TftitemData
    {
        return $this->fetch(
            '/v1/tftitems.json',
            collectionType: TftitemData::class,
            idField: 'id',
            id: $id,
        );
    }

    /**
     * @return Collection<int, TftmapskinData>
     */
    public function mapSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftmapskins.json',
            collectionType: TftmapskinData::class,
        );
    }

    /**
     * @return Collection<int, TftpassAssetData>
     */
    public function passAssets(): Collection
    {
        return $this->fetch(
            '/v1/tftpass-assets.json',
            collectionType: TftpassAssetData::class,
        );
    }

    /**
     * @return Collection<int, TftpasswelcomedatumData>
     */
    public function passWelcomeData(): Collection
    {
        return $this->fetch(
            '/v1/tftpasswelcomedata.json',
            collectionType: TftpasswelcomedatumData::class,
        );
    }

    /**
     * @return Collection<int, TftplaybookData>
     */
    public function playbooks(): Collection
    {
        return $this->fetch(
            '/v1/tftplaybooks.json',
            collectionType: TftplaybookData::class,
        );
    }

    /**
     * @return Collection<int, TftregionportalData>
     */
    public function regionPortals(): Collection
    {
        return $this->fetch(
            '/v1/tftregionportals.json',
            collectionType: TftregionportalData::class,
        );
    }

    /**
     * @return Collection<int, TftrotationalshopitemdatumData>
     */
    public function rotationalShopItemData(): Collection
    {
        return $this->fetch(
            '/v1/tftrotationalshopitemdata.json',
            collectionType: TftrotationalshopitemdatumData::class,
        );
    }

    /**
     * @return Collection<int, TftsetData>
     */
    public function sets(): Collection
    {
        return $this->fetch(
            '/v1/tftsets.json',
            collectionType: TftsetData::class,
        );
    }

    /**
     * @return Collection<int, TftskilltreeData>
     */
    public function skillTree(): Collection
    {
        return $this->fetch(
            '/v1/tftskilltree.json',
            collectionType: TftskilltreeData::class,
        );
    }

    /**
     * @return Collection<int, TfttraitData>
     */
    public function traits(): Collection
    {
        return $this->fetch(
            '/v1/tfttraits.json',
            collectionType: TfttraitData::class,
        );
    }

    /**
     * @return Collection<int, TfttrovesbannerrewardData>
     */
    public function trovesBannerRewards(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovesbannerrewards.json',
            collectionType: TfttrovesbannerrewardData::class,
        );
    }

    /**
     * @return Collection<int, TfttrovesbannerData>
     */
    public function trovesBanners(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovesbanners.json',
            collectionType: TfttrovesbannerData::class,
        );
    }

    /**
     * @return Collection<int, TfttrovestablesnameData>
     */
    public function trovesTablesNames(): Collection
    {
        return $this->fetch(
            '/v1/tfttrovestablesnames.json',
            collectionType: TfttrovestablesnameData::class,
        );
    }

    /**
     * @return Collection<int, TftuxtunableData>
     */
    public function uxTunables(): Collection
    {
        return $this->fetch(
            '/v1/tftuxtunables.json',
            collectionType: TftuxtunableData::class,
        );
    }

    /**
     * @return Collection<int, TftzoomskinData>
     */
    public function zoomSkins(): Collection
    {
        return $this->fetch(
            '/v1/tftzoomskins.json',
            collectionType: TftzoomskinData::class,
        );
    }
}
