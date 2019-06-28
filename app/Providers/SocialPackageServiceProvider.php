<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\src\MaSPack\Application\SocialPackage\Service\DetailSocialPackage;
use App\src\MaSPack\Application\SocialPackage\Service\ListSocialPackages;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\DeleteSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandler;
use App\src\MaSPack\Application\SocialPackage\Service\FindSocialPackage;
use App\src\MaSPack\Application\SocialPackage\Service\ListSubscriptions;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\SocialPackagesRepository;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\EmployeeRepository;

class SocialPackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('SocialPackagesRepository', function ($app) {
            return new SocialPackagesRepository();
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\Service\ListSocialPackages', function ($app) {
            return new ListSocialPackages($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\Service\DetailSocialPackage', function ($app) {
            return new DetailSocialPackage($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\CommandHandler\SaveSocialPackageCommandHandler', function ($app) {
            return new SaveSocialPackageCommandHandler($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\Service\FindSocialPackage', function ($app) {
            return new FindSocialPackage($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\Service\ListSubscriptions', function ($app) {
            return new ListSubscriptions($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\CommandHandler\EditSocialPackageCommandHandler', function ($app) {
            return new EditSocialPackageCommandHandler($app->make('SocialPackagesRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\SocialPackage\CommandHandler\DeleteSocialPackageCommandHandler', function ($app) {
            return new DeleteSocialPackageCommandHandler($app->make('SocialPackagesRepository'));
        });
        
        $this->app->bind('App\src\MaSPack\Application\SocialPackage\CommandHandler\SubscribeToSocialPackageCommandHandler', function ($app) {
            return new SubscribeToSocialPackageCommandHandler(
                $app->make('SocialPackagesRepository'),
                $app->make('EmployeeRepository')
            );
        });
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
