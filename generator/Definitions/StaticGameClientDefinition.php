<?php

/** @noinspection PhpInternalEntityUsedInspection */

namespace Phizz\Generator\Definitions;

use Illuminate\Support\Collection;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Helpers as GeneratorHelpers;
use Phizz\Generator\Interfaces\Writable;
use Phizz\Generator\Objects\CDragonEndpoint;
use Phizz\Generator\Traits\HasWrite;
use Phizz\Support\Helpers;
use Phizz\Support\StaticApi;

/**
 * Generates a game-scoped static client class (LolClient or TftClient).
 * Strips the game prefix from method names and applies word-boundary hints
 * for slugs that are all-lowercase compound words.
 *
 * @extends Definition<ClassType>
 */
class StaticGameClientDefinition extends Definition implements Writable
{
    use HasWrite;

    /**
     * Predefined slug → properly-cased alias for compound slugs that have no
     * word-boundary separators. The alias retains the game prefix so that the
     * prefix-stripping step works correctly.
     */
    private const SLUG_ALIASES = [
        'lolcurrency' => 'lolCurrency',
        'loleosrewards' => 'lolEosRewards',
        'lolinventorytype' => 'lolInventoryType',
        'lolseasonassets' => 'lolSeasonAssets',
        'tftcapmissioncollection' => 'tftCapMissionCollection',
        'tftchemtechstoredata' => 'tftChemtechStoreData',
        'tftcontentdata' => 'tftContentData',
        'tftcosmeticsdefault' => 'tftCosmeticsDefault',
        'tftdamageskins' => 'tftDamageSkins',
        'tftdisplaytags' => 'tftDisplayTags',
        'tftgamevariations' => 'tftGameVariations',
        'tftmapskins' => 'tftMapSkins',
        'tftpasswelcomedata' => 'tftPassWelcomeData',
        'tftregionportals' => 'tftRegionPortals',
        'tftrotationalshopitemdata' => 'tftRotationalShopItemData',
        'tftskilltree' => 'tftSkillTree',
        'tfttrovesbannerrewards' => 'tftTrovesBannerRewards',
        'tfttrovesbanners' => 'tftTrovesBanners',
        'tfttrovestablesnames' => 'tftTrovesTablesNames',
        'tftuxtunables' => 'tftUxTunables',
        'tftzoomskins' => 'tftZoomSkins',
        'achievementtitles' => 'achievementTitles',
        'championperkstylemap' => 'championPerkStyleMap',
        'leaderboardconfiguration' => 'leaderboardConfiguration',
        'nachobanners' => 'nachoBanners',
        'nachorewards' => 'nachoRewards',
        'nexusfinishers' => 'nexusFinishers',
        'settingstopersist' => 'settingsToPersist',
        'skinaugments' => 'skinAugments',
        'skinborders' => 'skinBorders',
        'skinlines' => 'skinLines',
        'statstones' => 'statStones',
    ];

    /**
     * @param  string  $game  'lol' or 'tft'
     * @param  CDragonEndpoint[]  $endpoints
     * @param  StaticDataDefinition[]  $dataDefinitions  Parallel to $endpoints.
     */
    public function __construct(
        public readonly string $game,
        private readonly array $endpoints,
        private readonly array $dataDefinitions,
    ) {}

    public function namespace(): string
    {
        return $this->resolveNamespace('CDragon');
    }

    public function directory(): string
    {
        return $this->resolvePath('CDragon');
    }

    public function imports(): array
    {
        $imports = [StaticApi::class];
        $hasCollection = false;

        foreach ($this->endpoints as $i => $endpoint) {
            $data = $this->dataDefinitions[$i];
            $imports[] = $data->className();

            if (! $endpoint->isDirectory && $endpoint->isArray) {
                $hasCollection = true;
            }
        }

        if ($hasCollection) {
            $imports[] = Collection::class;
        }

        return array_unique($imports);
    }

    public function definition(): ClassType
    {
        $className = $this->game === 'tft' ? 'TftClient' : 'LolClient';

        $class = (new ClassType($className))
            ->setExtends(StaticApi::class);

        foreach ($this->endpoints as $i => $endpoint) {
            $data = $this->dataDefinitions[$i];
            $dataShort = GeneratorHelpers::extractShortName($data->className());
            $methodName = $this->resolveMethodName($endpoint->slug);

            if ($endpoint->isDirectory || ! $endpoint->isArray) {
                $this->buildObjectMethod($class, $endpoint, $dataShort, $methodName, $data->className());
            } elseif ($endpoint->idField !== null) {
                $this->buildFlatWithIdMethod($class, $endpoint, $dataShort, $methodName, $data->className());
            } else {
                $this->buildFlatMethod($class, $endpoint, $dataShort, $methodName);
            }
        }

        return $class;
    }

    private function resolveMethodName(string $slug): string
    {
        $mapped = self::SLUG_ALIASES[strtolower($slug)] ?? $slug;

        if (str_starts_with(strtolower($mapped), $this->game)) {
            $mapped = lcfirst(substr($mapped, strlen($this->game)));
        }

        return Helpers::formatAttribute($mapped, Helpers::CAMEL_CASE);
    }

    private function buildObjectMethod(ClassType $class, CDragonEndpoint $endpoint, string $dataShort, string $methodName, string $dataFqcn): void
    {
        $method = $class->addMethod($methodName)
            ->setReturnType($dataFqcn)
            ->addComment("@return $dataShort");

        if ($endpoint->isDirectory) {
            $method->addParameter('id')->setType('int');
            $path = '"/v1/'.$endpoint->slug.'/{$id}.json"';
        } else {
            $path = '"/v1/'.$endpoint->slug.'.json"';
        }

        $method->setBody(
            'return $this->fetch('."\n".
            '    '.$path.','."\n".
            '    returnType: '.$dataShort.'::class,'."\n".
            ');'
        );
    }

    private function buildFlatWithIdMethod(ClassType $class, CDragonEndpoint $endpoint, string $dataShort, string $methodName, string $dataFqcn): void
    {
        $idField = $endpoint->idField;
        $method = $class->addMethod($methodName)
            ->setReturnType(Collection::class.'|'.$dataFqcn)
            ->addComment("@return Collection<int, $dataShort>|$dataShort");
        $method->addParameter('id')->setType('?int')->setDefaultValue(null);
        $method->setBody(
            'return $this->fetch('."\n".
            '    "/v1/'.$endpoint->slug.'.json",'."\n".
            '    collectionType: '.$dataShort.'::class,'."\n".
            '    idField: \''.$idField."',\n".
            '    id: $id,'."\n".
            ');'
        );
    }

    private function buildFlatMethod(ClassType $class, CDragonEndpoint $endpoint, string $dataShort, string $methodName): void
    {
        $method = $class->addMethod($methodName)
            ->setReturnType(Collection::class)
            ->addComment("@return Collection<int, $dataShort>");
        $method->setBody(
            'return $this->fetch('."\n".
            '    "/v1/'.$endpoint->slug.'.json",'."\n".
            '    collectionType: '.$dataShort.'::class,'."\n".
            ');'
        );
    }
}
