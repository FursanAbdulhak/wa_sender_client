<?php

namespace Alareqi\FilamentWhatsapp;

use Illuminate\Support\ServiceProvider;

class WaSenderClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/wa-sender-client.php', 'wa-sender-client');

        // Bind the WhatsApp client
        $this->app->bind('WaSenderClient', function () {
            return new WhatsappClient(
                config('wa-sender-client.apiUrl'),
                config('wa-sender-client.appkey'),
                config('wa-sender-client.authkey')
            );
        });

        $this->app->alias('WaSenderClient', 'Alareqi\FilamentWhatsapp\Facades\WaSenderClient');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load helper functions
        require_once __DIR__ . '/helpers.php';

        // Publish configuration
        $this->publishes([
            __DIR__ . '/../config/wa-sender-client.php' => config_path('wa-sender-client.php'),
        ], 'wa-sender-client-config');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'wa-sender-client');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/wa-sender-client'),
        ], 'wa-sender-client-views');

        // Load translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'wa-sender-client');

        // Publish translations
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/wa-sender-client'),
        ], 'wa-sender-client-translations');
    }
}
