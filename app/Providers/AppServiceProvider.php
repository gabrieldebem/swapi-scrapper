<?php

namespace App\Providers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Repositories\StarWarsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        StarWarsRepositoryInterface::class => StarWarsRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
