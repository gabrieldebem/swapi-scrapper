<?php

namespace App\Providers;

use App\Contracts\StarWarsRepositoryInterface;
use App\Services\StarWarsRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class StarWarsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $bindings = [
        StarWarsRepositoryInterface::class => StarWarsRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
