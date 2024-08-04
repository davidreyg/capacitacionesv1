<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        FilamentAsset::register([
            Js::make('TopNavigation', __DIR__ . '/../../resources/js/TopNavigation.js'),
        ]);

        //FIXME: En excludes va los id de los paneles o los roles?
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->excludes(function (): array {
                    // SI ES PROVEEDOR SOLO VE ESE PANEL DE PROVEEDOR
                    if (auth()->user()->isProveedor()) {
                        return ['admin', 'establecimiento'];
                    } else {
                        return ['proveedor'];
                    };
                })
                ->visible(fn() => auth()->user()->isEmpleado());

        });

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
            fn(): View => view('filament.hooks.header'),
        );
    }
}
