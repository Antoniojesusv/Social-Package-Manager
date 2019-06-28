<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\src\MaSPack\Infrastructure\Persistence\Eloquent\EmployeeRepository;
use App\src\MaSPack\Infrastructure\Import\FileReaderXLSX;
use App\src\MaSPack\Application\Employee\Service\ListEmployees;
use App\src\MaSPack\Application\Employee\CommandHandler\ImportEmployeesCommandHandler;
use App\src\MaSPack\Application\Employee\Service\FindEmployee;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('EmployeeRepository', function ($app) {
            return new EmployeeRepository();
        });

        $this->app->bind('FileReaderXLSX', function ($app) {
            return new FileReaderXLSX();
        });

        $this->app->bind('App\src\MaSPack\Application\Employee\Service\ListEmployees', function ($app) {
            return new ListEmployees($app->make('EmployeeRepository'));
        });

        $this->app->bind('App\src\MaSPack\Application\Employee\CommandHandler\ImportEmployeesCommandHandler', function ($app) {
            return new ImportEmployeesCommandHandler($app->make('EmployeeRepository'), $app->make('FileReaderXLSX'));
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
