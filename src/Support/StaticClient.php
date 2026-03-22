<?php

namespace Phizz\Support;

use GuzzleHttp\Client as Guzzle;

class StaticClient
{
    public const CDRAGON_BASE = 'https://raw.communitydragon.org';

    public const DDRAGON_BASE = 'https://ddragon.leagueoflegends.com';

    public const PLUGIN_BASE = 'plugins/rcp-be-lol-game-data/global/default';

    public const ASSET_PREFIX = '/lol-game-data/assets';

    private readonly Guzzle $guzzle;

    public function __construct(?Guzzle $guzzle = null)
    {
        $this->guzzle = $guzzle ?? new Guzzle;
    }

    /**
     * Fetches a JSON resource from CommunityDragon.
     * The path should start with "/" and include the version segment,
     * e.g. "/latest/plugins/rcp-be-lol-game-data/global/default/v1/items.json"
     */
    public function cdragon(string $path): array
    {
        return $this->fetch(self::CDRAGON_BASE.$path);
    }

    /**
     * Fetches a JSON resource from DDragon.
     * The path should start with "/", e.g. "/api/versions.json"
     */
    public function ddragon(string $path): array
    {
        return $this->fetch(self::DDRAGON_BASE.$path);
    }

    private function fetch(string $url): array
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $response = $this->guzzle->get($url);

        return json_decode((string) $response->getBody(), true);
    }
}
