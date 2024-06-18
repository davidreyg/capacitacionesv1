<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Table::configureUsing(function (Table $table): void {
            $table
                ->defaultPaginationPageOption(10)
                ->paginated([10, 25, 50, 100])
                ->extremePaginationLinks();
        });

        FilamentAsset::register([
            Js::make('TopNavigation', __DIR__ . '/../../resources/js/TopNavigation.js'),
        ]);

        /* Para que funcione el SPA. y para que carguen los ASSETS */
        if (config('app.env') === 'production') {
            $this->app['request']->server->set('HTTPS', 'on');
            \URL::forceScheme('https');
        }
    }
}
