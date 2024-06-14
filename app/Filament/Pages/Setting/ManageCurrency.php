<?php

namespace App\Filament\Pages\Setting;

use App\Settings\CurrencySettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class ManageCurrency extends SettingsPage
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'tabler-settings-dollar';
    protected static ?int $navigationSort = 99;
    protected static string $settings = CurrencySettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Configuracion')
                            ->icon('tabler-settings-dollar')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('code')->label('Código')->required(),
                                        Forms\Components\TextInput::make('name')->label('Nombre')->required(),
                                        Forms\Components\TextInput::make('precision')->label('Precisión')->numeric()->required(),
                                        Forms\Components\TextInput::make('symbol')->label('Símbolo')->required(),
                                        Forms\Components\TextInput::make('decimal_mark')->label('Separador de decimales')->required(),
                                        Forms\Components\TextInput::make('thousands_separator')->label('Separador de miles')->required(),
                                        Forms\Components\Toggle::make('symbol_first')->inline(false)->label('Símbolo al inicio')->required(),
                                    ])
                                    ->columns(3),
                            ])
                    ])
                    ->columnSpan([
                        "md" => 2
                    ]),
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.settings");
    }

    public static function getNavigationLabel(): string
    {
        return 'Moneda';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Configuración de Moneda';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Configuracion de Moneda';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Gestionar la configuracion de la moneda';
    }
}
