<?php

namespace App\Providers;

use App\Models\Coach;
use App\Models\Personnel;
use App\Models\Volunteer;
use App\Observers\ClubComplianceObserver;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        Personnel::observe(ClubComplianceObserver::class);
        Coach::observe(ClubComplianceObserver::class);
        Volunteer::observe(ClubComplianceObserver::class);

        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Amber, // or Color::Blue
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }
}
