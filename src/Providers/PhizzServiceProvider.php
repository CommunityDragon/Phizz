<?php

namespace Phizz\Providers;

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
            $config = $app['config'];
            $cache = $app['cache']->store($config->get('phizz.cache.store'));
            $configuration = new Configuration($config, $cache);

            return new Phizz($configuration);
        });
    }
}
