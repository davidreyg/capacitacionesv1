<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Pages\Auth\Login;
use App\Http\Middleware\ConfigureCurrentPanel;
use App\Http\Middleware\ForceHttps;
use App\Livewire\MyProfileExtended;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProveedorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('proveedor')
            ->path('proveedor')
            ->login(Login::class)
            ->globalSearch(false)
            ->sidebarCollapsibleOnDesktop()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Proveedor/Resources'), for: 'App\\Filament\\Proveedor\\Resources')
            ->discoverPages(in: app_path('Filament/Proveedor/Pages'), for: 'App\\Filament\\Proveedor\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Proveedor/Widgets'), for: 'App\\Filament\\Proveedor\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->middleware([
                ConfigureCurrentPanel::class,
                ForceHttps::class,
            ], isPersistent: true)
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \Jeffgreco13\FilamentBreezy\BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: false,
                        navigationGroup: 'Settings',
                        hasAvatars: true,
                        slug: 'my-profile'
                    )
                    ->myProfileComponents(
                        [
                            'personal_info' => MyProfileExtended::class,
                        ]
                    ),
            ]);
        ;
    }
}
