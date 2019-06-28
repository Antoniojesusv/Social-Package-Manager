<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\src\MaSPack\Application\Subscription\Service\ListSubscriptions;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\SubscriptionRepository;

class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\src\MaSPack\Domain\Subscription\SubscriptionRepositoryInterface',
            'App\src\MaSPack\Infrastructure\Persistence\Eloquent\SubscriptionRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
