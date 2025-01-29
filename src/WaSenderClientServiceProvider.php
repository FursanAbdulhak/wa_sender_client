<?php

namespace Alareqi\FilamentWhatsapp;


use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WaSenderClientServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('wa-sender-client')
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function registeringPackage(): void
    {
        $this->publishes([
            __DIR__ . '/../config/wa-sender-client.php' => config_path('wa-sender-client.php',),
        ], 'wa-sender-client');


        $this->app->bind('WaSenderClient', function ($app) {
            return new WhatsappClient(
                config('wa-sender-client.apiUrl'),
                config('wa-sender-client.appkey'),
                config('wa-sender-client.authkey')
            );
        });

        $this->app->alias('WaSenderClient', 'Alareqi\FilamentWhatsapp\Facades\WaSenderClient');
    }

    public function packageBooted(): void
    {
        parent::packageBooted();
    }
}
