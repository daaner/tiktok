<?php

namespace Daaner\TikTok;

use Illuminate\Support\ServiceProvider;

class TikTokServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tiktok.php' => config_path('tiktok.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/lang' => "{$this->app['path.lang']}/vendor/tiktok",
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'tiktok');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tiktok.php', 'tiktok');

        $this->app->singleton('tiktok', function () {
            return $this->app->make(TikTok::class);
        });

        $this->app->alias('tiktok', 'TikTok');
    }
}
