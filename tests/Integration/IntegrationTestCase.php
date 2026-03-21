<?php

namespace Phizz\Tests\Integration;

use Orchestra\Testbench\TestCase as Orchestra;
use Phizz\Providers\PhizzServiceProvider;
use Phizz\TTL;

class IntegrationTestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [PhizzServiceProvider::class];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('cache.default', 'array');
        config()->set('phizz.api_key', $this->resolveApiKey());
        config()->set('phizz.default_platform', 'na1');
        config()->set('phizz.timeout', 30);
        config()->set('phizz.cache.enabled', true);
        config()->set('phizz.cache.default', 60);
        config()->set('phizz.cache.method', [
            TTL::riot::accountV1::getByRiotId => 3600,
        ]);
    }

    private function resolveApiKey(): string
    {
        $envFile = dirname(__DIR__, 2).'/.env';

        if (file_exists($envFile)) {
            foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                if (str_starts_with($line, 'RIOT_API_KEY')) {
                    [, $value] = explode('=', $line, 2);

                    return trim($value, '"\'');
                }
            }
        }

        return (string) getenv('RIOT_API_KEY');
    }
}
