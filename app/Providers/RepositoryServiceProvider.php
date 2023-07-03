<?php

namespace App\Providers;

use App\Interfaces\ItemInterface;
use App\Repositories\ItemRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ItemInterface::class,ItemRepository::class);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
