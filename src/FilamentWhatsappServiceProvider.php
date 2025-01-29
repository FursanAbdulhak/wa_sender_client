<?php

namespace Alareqi\FilamentWhatsapp;


use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentWhatsappServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-whatsapp')
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function registeringPackage(): void
    {
        $this->publishes([
            __DIR__ . '/../config/filament-whatsapp.php' => config_path('filament-whatsapp.php',),
        ], 'filament-whatsapp');


        $this->app->bind('whatsapp', function ($app) {
            return new WhatsappClient(
                config('filament-whatsapp.apiUrl'),
                config('filament-whatsapp.appkey'),
                config('filament-whatsapp.authkey')
            );
        });

        $this->app->alias('Whatsapp', 'Alareqi\FilamentWhatsapp\Facades\Whatsapp');
    }

    public function packageBooted(): void
    {
        parent::packageBooted();
    }
}
