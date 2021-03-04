<?php

namespace Pyskunov\LaravelApiResponse;

use Illuminate\Http\JsonResponse;
use \Illuminate\Support\ServiceProvider;
use Pyskunov\LaravelApiResponse\Mixins\JsonResponseMixinInterface;

class LaravelApiResponseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-api-response.php', 'laravel-api-response');

        $this->app->bind(JsonResponseMixinInterface::class, config('laravel-api-response.mixins.class'));
    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'laravel-api-response');

        $this->publishes(
            [
                __DIR__ . '/../config/laravel-api-response.php' => config_path('laravel-api-response.php'),
                __DIR__ . '/LaravelApiResponseServiceProvider.php' => app_path('Providers/LaravelApiResponseServiceProvider.php'),
            ]
        );

        JsonResponse::mixin(
            $this->app->make(JsonResponseMixinInterface::class)
        );
    }
}
