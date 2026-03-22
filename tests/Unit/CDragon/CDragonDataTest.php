<?php

use Phizz\CDragon\Champions\Objects\ChampionData;
use Phizz\CDragon\Champions\Objects\PassiveData;
use Phizz\CDragon\Champions\Objects\SkinData;
use Phizz\CDragon\Champions\Objects\SpellData;
use Phizz\Support\StaticData;

it('stores camelCase attributes as snake_case', function () {
    $data = new class(['squarePortraitPath' => '/lol-game-data/assets/v1/foo.png'], 'latest') extends StaticData {};

    expect($data->square_portrait_path)->toBe('/lol-game-data/assets/v1/foo.png');
});

it('stores plain snake_case attributes unchanged', function () {
    $data = new class(['is_base' => true], 'latest') extends StaticData {};

    expect($data->is_base)->toBeTrue();
});

it('casts nested objects declared in $objects using snake_case keys', function () {
    $nestedClass = new class([], 'v') extends StaticData {};

    $data = new class(['tacticalInfo' => ['style' => 2]], $nestedClass::class, 'v') extends StaticData
    {
        public function __construct(array $attrs, string $nestedClass, string $version)
        {
            $this->objects = ['tactical_info' => $nestedClass];
            parent::__construct($attrs, $version);
        }
    };

    expect($data->tacticalInfo)->toBeInstanceOf($nestedClass::class);
});

it('threads version into nested objects', function () {
    $nestedClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $data = new class(['info' => ['val' => 1]], $nestedClass::class, '14.5') extends StaticData
    {
        public function __construct(array $attrs, string $nestedClass, string $version)
        {
            $this->objects = ['info' => $nestedClass];
            parent::__construct($attrs, $version);
        }
    };

    expect($data->info->getVersion())->toBe('14.5');
});

it('casts typed collections declared in $collections using snake_case keys', function () {
    $itemClass = new class([], 'v') extends StaticData {};

    $data = new class(['skinLines' => [['id' => 1], ['id' => 2]]], $itemClass::class, 'v') extends StaticData
    {
        public function __construct(array $attrs, string $itemClass, string $version)
        {
            $this->collections = ['skin_lines' => $itemClass];
            parent::__construct($attrs, $version);
        }
    };

    expect($data->skinLines)->toHaveCount(2)
        ->and($data->skinLines->first())->toBeInstanceOf($itemClass::class);
});

it('threads version into collection items', function () {
    $itemClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $data = new class(['items' => [['id' => 1]]], $itemClass::class, '14.6') extends StaticData
    {
        public function __construct(array $attrs, string $itemClass, string $version)
        {
            $this->collections = ['items' => $itemClass];
            parent::__construct($attrs, $version);
        }
    };

    expect($data->items->first()->getVersion())->toBe('14.6');
});

it('strips the /lol-game-data/assets prefix and prepends the CommunityDragon base URL', function () {
    $data = new class([], '14.1') extends StaticData
    {
        public function testUrl(string $path): string
        {
            return $this->toUrl($path);
        }
    };

    $url = $data->testUrl('/lol-game-data/assets/v1/champion-icons/103.png');

    expect($url)->toBe(
        'https://raw.communitydragon.org/14.1/plugins/rcp-be-lol-game-data/global/default/v1/champion-icons/103.png'
    );
});

it('lowercases the path portion', function () {
    $data = new class([], 'latest') extends StaticData
    {
        public function testUrl(string $path): string
        {
            return $this->toUrl($path);
        }
    };

    $url = $data->testUrl('/lol-game-data/assets/V1/Champion-Icons/103.png');

    expect($url)->toContain('/v1/champion-icons/103.png');
});

it('casts ChampionData with passive and spells correctly', function () {
    $fixture = [
        'id' => 103,
        'name' => 'Ahri',
        'alias' => 'Ahri',
        'title' => 'the Nine-Tailed Fox',
        'shortBio' => 'Bio.',
        'isVisibleInClient' => true,
        'squarePortraitPath' => '/lol-game-data/assets/v1/champion-icons/103.png',
        'stingerSfxPath' => '/lol-game-data/assets/v1/champion-sfx-audios/103.ogg',
        'chooseVoPath' => '/lol-game-data/assets/v1/champion-choose-vo/103.ogg',
        'banVoPath' => '/lol-game-data/assets/v1/champion-ban-vo/103.ogg',
        'roles' => ['mage'],
        'recommendedItemDefaults' => [],
        'tacticalInfo' => ['style' => 2, 'difficulty' => 2, 'damageType' => 'magic'],
        'playstyleInfo' => ['damage' => 8, 'durability' => 3, 'crowdControl' => 4, 'mobility' => 7, 'utility' => 4],
        'championTagInfo' => ['associatedChampionTagId' => 0, 'associatedChampionTagName' => ''],
        'passive' => [
            'name' => 'Essence Theft',
            'abilityIconPath' => '/lol-game-data/assets/v1/passive/Ahri_P.png',
            'abilityVideoPath' => '/lol-game-data/assets/v1/passive/Ahri_P.webm',
            'abilityVideoImagePath' => '/lol-game-data/assets/v1/passive/Ahri_P_video.jpg',
            'description' => 'Ahri gains a Soul...',
        ],
        'spells' => [
            ['spellKey' => 'Q', 'name' => 'Orb of Deception', 'abilityIconPath' => '/lol-game-data/assets/v1/spell/AhriOrbMissile.png', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'cost' => '', 'cooldown' => '', 'description' => '', 'dynamicDescription' => '', 'range' => [], 'costCoefficients' => [], 'cooldownCoefficients' => [], 'coefficients' => ['coefficient1' => 0, 'coefficient2' => 0], 'effectAmounts' => ['effect1amount' => []], 'ammo' => ['ammoRechargeTime' => [], 'maxAmmo' => []], 'maxLevel' => 5],
            ['spellKey' => 'W', 'name' => 'Fox-Fire', 'abilityIconPath' => '/lol-game-data/assets/v1/spell/AhriFoxFire.png', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'cost' => '', 'cooldown' => '', 'description' => '', 'dynamicDescription' => '', 'range' => [], 'costCoefficients' => [], 'cooldownCoefficients' => [], 'coefficients' => ['coefficient1' => 0, 'coefficient2' => 0], 'effectAmounts' => ['effect1amount' => []], 'ammo' => ['ammoRechargeTime' => [], 'maxAmmo' => []], 'maxLevel' => 5],
            ['spellKey' => 'E', 'name' => 'Charm', 'abilityIconPath' => '/lol-game-data/assets/v1/spell/AhriSeduceMissile.png', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'cost' => '', 'cooldown' => '', 'description' => '', 'dynamicDescription' => '', 'range' => [], 'costCoefficients' => [], 'cooldownCoefficients' => [], 'coefficients' => ['coefficient1' => 0, 'coefficient2' => 0], 'effectAmounts' => ['effect1amount' => []], 'ammo' => ['ammoRechargeTime' => [], 'maxAmmo' => []], 'maxLevel' => 5],
            ['spellKey' => 'R', 'name' => 'Spirit Rush', 'abilityIconPath' => '/lol-game-data/assets/v1/spell/AhriTumble.png', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'cost' => '', 'cooldown' => '', 'description' => '', 'dynamicDescription' => '', 'range' => [], 'costCoefficients' => [], 'cooldownCoefficients' => [], 'coefficients' => ['coefficient1' => 0, 'coefficient2' => 0], 'effectAmounts' => ['effect1amount' => []], 'ammo' => ['ammoRechargeTime' => [], 'maxAmmo' => []], 'maxLevel' => 3],
        ],
        'skins' => [
            ['id' => 103000, 'contentId' => 'abc', 'isBase' => true, 'name' => 'default', 'skinClassification' => 'base', 'splashPath' => '/lol-game-data/assets/v1/champion-splashes/103/103000.jpg', 'uncenteredSplashPath' => '/lol-game-data/assets/v1/champion-splashes/uncentered/103/103000.jpg', 'tilePath' => '/lol-game-data/assets/v1/champion-tiles/103/103000.jpg', 'loadScreenPath' => '/lol-game-data/assets/v1/champion-loadscreen/103/103000.jpg', 'skinType' => '', 'rarity' => 'kNoRarity', 'isLegacy' => false, 'splashVideoPath' => null, 'previewVideoUrl' => null, 'collectionSplashVideoPath' => null, 'collectionCardHoverVideoPath' => null, 'featuresText' => null, 'chromaPath' => null, 'emblems' => null, 'regionRarityId' => 0, 'rarityGemPath' => null, 'skinLines' => null, 'description' => null],
        ],
    ];

    $champion = new ChampionData($fixture, 'latest');

    expect($champion->id)->toBe(103)
        ->and($champion->name)->toBe('Ahri')
        ->and($champion->passive)->toBeInstanceOf(PassiveData::class)
        ->and($champion->passive->name)->toBe('Essence Theft')
        ->and($champion->spells)->toHaveCount(4)
        ->and($champion->spells->first())->toBeInstanceOf(SpellData::class)
        ->and($champion->spells->first()->name)->toBe('Orb of Deception')
        ->and($champion->skins)->toHaveCount(1)
        ->and($champion->skins->first())->toBeInstanceOf(SkinData::class)
        ->and($champion->skins->first()->id)->toBe(103000);
});

it('generates correct squarePortraitUrl from ChampionData', function () {
    $champion = new ChampionData([
        'id' => 103,
        'name' => 'Ahri',
        'squarePortraitPath' => '/lol-game-data/assets/v1/champion-icons/103.png',
        'passive' => ['name' => 'P', 'abilityIconPath' => '', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'description' => ''],
        'spells' => [],
        'skins' => [],
        'tacticalInfo' => ['style' => 0, 'difficulty' => 0, 'damageType' => ''],
        'playstyleInfo' => ['damage' => 0, 'durability' => 0, 'crowdControl' => 0, 'mobility' => 0, 'utility' => 0],
        'championTagInfo' => ['associatedChampionTagId' => 0, 'associatedChampionTagName' => ''],
    ], '14.1');

    expect($champion->squarePortraitUrl())->toBe(
        'https://raw.communitydragon.org/14.1/plugins/rcp-be-lol-game-data/global/default/v1/champion-icons/103.png'
    );
});

it('threads version into PassiveData so abilityIconUrl is correct', function () {
    $passive = new PassiveData([
        'name' => 'Essence Theft',
        'abilityIconPath' => '/lol-game-data/assets/v1/passive/Ahri_P.png',
        'abilityVideoPath' => '',
        'abilityVideoImagePath' => '',
        'description' => '',
    ], '14.2');

    expect($passive->abilityIconUrl())->toBe(
        'https://raw.communitydragon.org/14.2/plugins/rcp-be-lol-game-data/global/default/v1/passive/ahri_p.png'
    );
});

it('threads version into SkinData nested inside ChampionData', function () {
    $fixture = [
        'id' => 103,
        'name' => 'Ahri',
        'squarePortraitPath' => '/lol-game-data/assets/v1/champion-icons/103.png',
        'passive' => ['name' => 'P', 'abilityIconPath' => '', 'abilityVideoPath' => '', 'abilityVideoImagePath' => '', 'description' => ''],
        'spells' => [],
        'skins' => [
            ['id' => 103000, 'contentId' => 'abc', 'isBase' => true, 'name' => 'default', 'skinClassification' => 'base', 'splashPath' => '/lol-game-data/assets/v1/champion-splashes/103/103000.jpg', 'uncenteredSplashPath' => '/lol-game-data/assets/v1/champion-splashes/uncentered/103/103000.jpg', 'tilePath' => '/lol-game-data/assets/v1/champion-tiles/103/103000.jpg', 'loadScreenPath' => '/lol-game-data/assets/v1/champion-loadscreen/103/103000.jpg', 'skinType' => '', 'rarity' => 'kNoRarity', 'isLegacy' => false, 'splashVideoPath' => null, 'previewVideoUrl' => null, 'collectionSplashVideoPath' => null, 'collectionCardHoverVideoPath' => null, 'featuresText' => null, 'chromaPath' => null, 'emblems' => null, 'regionRarityId' => 0, 'rarityGemPath' => null, 'skinLines' => null, 'description' => null],
        ],
        'tacticalInfo' => ['style' => 0, 'difficulty' => 0, 'damageType' => ''],
        'playstyleInfo' => ['damage' => 0, 'durability' => 0, 'crowdControl' => 0, 'mobility' => 0, 'utility' => 0],
        'championTagInfo' => ['associatedChampionTagId' => 0, 'associatedChampionTagName' => ''],
    ];

    $champion = new ChampionData($fixture, '14.3');
    $skin = $champion->skins->first();

    expect($skin->splashUrl())->toContain('14.3');
});

// StaticData::castUsing / of

it('castUsing get returns null when value is null', function () {
    $cast = (new class([], '') extends StaticData {})->castUsing([]);

    expect($cast->get(null, 'field', null, []))->toBeNull();
});

it('castUsing get deserializes a JSON string and threads the version', function () {
    $dataClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $cast = $dataClass::castUsing(['14.5']);
    $result = $cast->get(null, 'field', json_encode(['id' => 1]), []);

    expect($result)->toBeInstanceOf($dataClass::class)
        ->and($result->getVersion())->toBe('14.5');
});

it('castUsing get accepts a plain array', function () {
    $dataClass = new class([], '') extends StaticData {};

    $cast = $dataClass::castUsing([]);
    $result = $cast->get(null, 'field', ['id' => 7], []);

    expect($result)->toBeInstanceOf($dataClass::class)
        ->and($result->id)->toBe(7);
});

it('castUsing set returns null when value is null', function () {
    $cast = (new class([], '') extends StaticData {})->castUsing([]);

    expect($cast->set(null, 'field', null, []))->toBeNull();
});

it('castUsing set JSON-encodes the data instance', function () {
    $dataClass = new class(['name' => 'Ahri'], '') extends StaticData {};
    $fqcn = $dataClass::class;

    $cast = $dataClass::castUsing([]);
    $instance = new $fqcn(['name' => 'Ahri'], '');
    $json = $cast->set(null, 'field', $instance, []);

    expect(json_decode($json, true))->toBe(['name' => 'Ahri']);
});

it('of() with version produces cast that threads that version', function () {
    $dataClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $cast = $dataClass::of('15.3');
    $result = $cast->get(null, 'field', json_encode(['id' => 1]), []);

    expect($result->getVersion())->toBe('15.3');
});

it('of() without arguments defaults version to empty string', function () {
    $dataClass = new class([], '') extends StaticData
    {
        public function getVersion(): string
        {
            return $this->version;
        }
    };

    $cast = $dataClass::of();
    $result = $cast->get(null, 'field', json_encode(['id' => 1]), []);

    expect($result->getVersion())->toBe('');
});
