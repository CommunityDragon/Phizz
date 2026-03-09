<?php

namespace Phizz\Providers;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Phizz\Phizz;
use Phizz\Support\Configuration;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PhizzServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('phizz')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this->app->bind(Phizz::class, function (ApplicationContract $app) {
            /** @var ConfigContract $config */
            $config = $app['config'];

            $config = new Configuration(
                apiKey: $config->get('phizz.api_key'),
                platform: $config->get('phizz.default_platform')
            );

            return new Phizz(
                config: $config,
                client: new Guzzle,
            );
        });
    }
}
