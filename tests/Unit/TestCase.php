<?php

namespace Phizz\Tests\Unit;

use Orchestra\Testbench\TestCase as Orchestra;
use Phizz\Providers\PhizzServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [PhizzServiceProvider::class];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('cache.default', 'array');
        config()->set('phizz.api_key', 'RGAPI-test-key');
        config()->set('phizz.default_platform', 'na1');
        config()->set('phizz.timeout', 30);
        config()->set('phizz.cache.enabled', false);
        config()->set('phizz.cache.default', 60);
        config()->set('phizz.cache.method', []);
    }
}
