<?php

namespace App\Providers;

use App\Services\TopicService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TopicService::class, function ($app) {
            return new TopicService($app->make('App\Repositories\TopicRepository'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
