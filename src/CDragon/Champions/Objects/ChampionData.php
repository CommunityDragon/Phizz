<?php

namespace Phizz\CDragon\Champions\Objects;

use Illuminate\Support\Collection;
use Phizz\Support\StaticData;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $alias
 * @property-read string $title
 * @property-read string $short_bio
 * @property-read bool $is_visible_in_client
 * @property-read TacticalInfoData $tacticalInfo
 * @property-read PlaystyleInfoData $playstyleInfo
 * @property-read ChampionTagInfoData $championTagInfo
 * @property-read string $square_portrait_path
 * @property-read string $stinger_sfx_path
 * @property-read string $choose_vo_path
 * @property-read string $ban_vo_path
 * @property-read array $roles
 * @property-read array $recommended_item_defaults
 * @property-read Collection<int, SkinData> $skins
 * @property-read PassiveData $passive
 * @property-read Collection<int, SpellData> $spells
 */
class ChampionData extends StaticData
{
    protected array $objects = [
        'tactical_info' => TacticalInfoData::class,
        'playstyle_info' => PlaystyleInfoData::class,
        'champion_tag_info' => ChampionTagInfoData::class,
        'passive' => PassiveData::class,
    ];

    protected array $collections = [
        'skins' => SkinData::class,
        'spells' => SpellData::class,
    ];

    public function squarePortraitUrl(): string
    {
        return $this->toUrl($this->square_portrait_path);
    }

    public function stingerSfxUrl(): string
    {
        return $this->toUrl($this->stinger_sfx_path);
    }

    public function chooseVoUrl(): string
    {
        return $this->toUrl($this->choose_vo_path);
    }

    public function banVoUrl(): string
    {
        return $this->toUrl($this->ban_vo_path);
    }
}
