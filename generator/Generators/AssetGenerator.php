<?php

namespace Phizz\Generator\Generators;

use Phizz\Generator\Definitions\CDragonClientDefinition;
use Phizz\Generator\Definitions\Definition;
use Phizz\Generator\Definitions\StaticDataDefinition;
use Phizz\Generator\Definitions\StaticGameClientDefinition;

class AssetGenerator extends Generator
{
    /**
     * @return Definition[]
     */
    public function definitions(): array
    {
        $endpoints = $this->config->endpoints;

        $dataDefinitions = [];
        $lolEndpoints = [];
        $lolData = [];
        $tftEndpoints = [];
        $tftData = [];

        foreach ($endpoints as $endpoint) {
            $game = str_starts_with(strtolower($endpoint->slug), 'tft') ? 'tft' : 'lol';
            $data = new StaticDataDefinition($endpoint, game: $game);
            $dataDefinitions[] = $data;

            foreach ($data->nestedDefinitions() as $nested) {
                $dataDefinitions[] = $nested;
            }

            if ($game === 'tft') {
                $tftEndpoints[] = $endpoint;
                $tftData[] = $data;
            } else {
                $lolEndpoints[] = $endpoint;
                $lolData[] = $data;
            }
        }

        $lolClientDef = new StaticGameClientDefinition('lol', $lolEndpoints, $lolData);
        $tftClientDef = new StaticGameClientDefinition('tft', $tftEndpoints, $tftData);

        return [...$dataDefinitions, $lolClientDef, $tftClientDef, new CDragonClientDefinition];
    }
}
