<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use App\Repositories\BaseRepository;
use App\Repositories\Dbrepository;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(App\Repositories\BaseRepository::class, App\Repositories\DbRepository::class);
        $this->app->singleton(App\Repositories\BaseRepository::class, App\Repositories\UserRepository::class);
        $this->app->singleton(App\Repositories\BaseRepository::class, App\Repositories\FavorisRepository::class);
        $this->app->singleton(App\Repositories\BaseRepository::class, App\Repositories\MoneyRepository::class);
    }
}
