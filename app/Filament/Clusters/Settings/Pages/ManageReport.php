<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings;
use App\Settings\ReportSettings;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;

class ManageReport extends SettingsPage
{
    protected static ?string $navigationIcon = 'tabler-file-type-pdf';
    protected static ?int $navigationSort = 2;

    protected static string $settings = ReportSettings::class;

    protected static ?string $cluster = Settings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getContentSection(),
                $this->getTemplateSection(),
            ]);
    }
    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::ScreenTwoExtraLarge;
    }

    protected function getContentSection(): Component
    {
        return Section::make('Content')
            ->schema([
                TextInput::make('header')
                    ->live()
                    ->required(),
                TextInput::make('subheader')
                    ->live()
                    ->nullable(),
                Textarea::make('terms')
                    ->live()
                    ->nullable(),
                Textarea::make('footer')
                    ->live()
                    ->nullable(),
            ])->columns();
    }

    protected function getTemplateSection(): Component
    {
        return Section::make('Template')
            ->description('Configure su template para los reportes.')
            ->schema([
                ViewField::make('preview.default')
                    // ->columnSpanFull()
                    ->hiddenLabel()
                    // ->visible(static fn(Get $get) => $get('template') === 'default')
                    ->view('components.pdf.layouts.default'),
            ]);
    }

    public function sendSuccessNotification($title)
    {
        Notification::make()
            ->title($title)
            ->success()
            ->send();
    }

    public function sendErrorNotification($title)
    {
        Notification::make()
            ->title($title)
            ->danger()
            ->send();
    }

    public static function getNavigationLabel(): string
    {
        return 'Reportes';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Reportes';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Reportes';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Gestionar la configuracion de la apariencia';
    }
}
