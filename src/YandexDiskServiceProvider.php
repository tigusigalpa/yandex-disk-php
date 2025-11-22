<?php

namespace Tigusigalpa\YandexDisk;

use Illuminate\Support\ServiceProvider;
use RuntimeException;

class YandexDiskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/yandex-disk.php',
            'yandex-disk'
        );

        $this->app->singleton(YandexDiskClient::class, function ($app) {
            $accessToken = config('yandex-disk.access_token');

            if (empty($accessToken)) {
                throw new RuntimeException('Yandex Disk access token is not configured');
            }

            return new YandexDiskClient($accessToken);
        });

        $this->app->alias(YandexDiskClient::class, 'yandex-disk');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/yandex-disk.php' => config_path('yandex-disk.php'),
            ], 'yandex-disk-config');
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [YandexDiskClient::class, 'yandex-disk'];
    }
}
