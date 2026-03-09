<?php

namespace Phizz\Support;

use Exception;
use Illuminate\Support\Str;
use Phizz\Enums\Platform;
use Phizz\Enums\Regional;
use Phizz\Enums\ValPlatform;

abstract class Api extends Constructable
{
    /**
     * @throws null
     */
    protected function fetch(
        string $method,
        string $endpoint,
        bool $returns,
        string $platformType,
        ?string $returnType = null,
        ?string $collectionType = null,
        Regional|Platform|ValPlatform|string|null $platform = null,
        array $platforms = [],
        array $query = [],
    ) {
        $platform = $platform ?? $this->platform ?? $this->config->platform;

        if (blank($platform)) {
            throw new Exception("Invalid platform type '".$platform."' for endpoint '$endpoint'.");
        }

        if (is_string($platform)) {
            $x = blank($platformType) ? null : $platformType::tryFrom($platform);
            $platform = $x ?? Platform::tryFrom($platform) ?? $platform;
        }

        if ($platformType === Regional::class && $platform instanceof Platform) {
            $platform = Str::startsWith($endpoint, '/lor/')
                ? $platform->lorRegional()
                : $platform->regional();
        }

        if (! is_string($platform) && get_class($platform) !== $platformType) {
            throw new Exception("Invalid platform type '".get_class($platform)."' for endpoint '$endpoint'.");
        }

        $platform = is_string($platform) ? $platform : $platform->value;

        if (! empty($platforms) && ! in_array($platform, $platforms)) {
            throw new Exception("Invalid platform type '".$platform."' for endpoint '$endpoint'.");
        }

        $url = "https://$platform.api.riotgames.com$endpoint";

        $q = [];
        foreach ($query as $key => $value) {
            if (blank($value)) {
                continue;
            }
            $q[$key] = $value;
        }

        $res = $this->client->request($method, $url, [
            'query' => $q,
            'headers' => [
                'X-Riot-Token' => $this->config->apiKey,
            ],
        ]);

        if (! $returns) {
            return;
        }

        $body = json_decode($res->getBody(), true);
        if (! blank($returnType)) {
            return new $returnType($body);
        }
        if (! blank($collectionType)) {
            return collect($body)->map(fn ($item) => new $collectionType($item));
        }

        return $body;
    }
}
