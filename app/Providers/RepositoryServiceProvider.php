<?php

namespace App\Providers;

use App\Interfaces\CartRepositoryInterface;
use App\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
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
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }
}
