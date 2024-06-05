<?php

namespace App\Providers;

use App\Models\Season;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        View::share('seasons_filtros', Season::all());
        View::share('temporada_activa', Setting::first());
    }
}
