<?php

namespace App\Providers;

use App\Mixins\BluePrintMixins;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        Blueprint::mixin(new BluePrintMixins());

        FilamentAsset::register([
            Css::make('scrollbar.css', __DIR__.'/../../resources/css/scrollbar.css'),
        ]);
    }
}
