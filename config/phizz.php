<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Riot Games API Key
    |--------------------------------------------------------------------------
    |
    | Your Riot Games API key. You can obtain one from the Riot Developer Portal.
    | It is recommended to store this in your .env file as RIOT_API_KEY.
    |
    */

    'api_key' => env('RIOT_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Platform
    |--------------------------------------------------------------------------
    |
    | The platform region to use when making API calls. This can be overridden
    | on a per‑call basis.
    |
    */

    'default_platform' => env('RIOT_DEFAULT_PLATFORM', \Phizz\Enums\Platform::NA),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout (seconds)
    |--------------------------------------------------------------------------
    |
    | The maximum number of seconds to wait for a response from the Riot API.
    |
    */

    'timeout' => env('RIOT_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Enable or disable caching of API responses.
    |
    */

    'cache' => [
        'enabled' => env('RIOT_CACHE_ENABLED', true),
        'default' => env('RIOT_CACHE_TTL', 60), // 1 minute
        'method' => [
            // You can define method‑specific cache ttl's here
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Log all API requests and responses? Useful for debugging.
    |
    */

    'logging' => [
        'enabled' => env('RIOT_LOGGING_ENABLED', false),
    ],

];
