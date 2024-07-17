<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Enums\Setting\DateFormat;
use App\Enums\Setting\TimeFormat;
use App\Enums\Setting\WeekStart;
use App\Filament\Clusters\Settings;
use App\Settings\LocalizationSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;
use function Filament\Support\is_app_url;

class ManageLocalization extends SettingsPage
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = LocalizationSettings::class;

    protected static ?string $cluster = Settings::class;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $data = $this->mutateFormDataBeforeFill(app(static::getSettings())->toArray());

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getDateAndTimeSection(),
            ]);
    }

    protected function getDateAndTimeSection(): Section
    {
        return Section::make('Date & Time')
            ->schema([
                Select::make('date_format')
                    ->native(false)
                    ->options(DateFormat::class)
                    ->live(),
                Select::make('time_format')
                    ->native(false)
                    ->options(TimeFormat::class),
                Select::make('week_start')
                    ->native(false)
                    ->options(WeekStart::class),
            ])->columns();
    }

    public function save(LocalizationSettings $settings = null): void
    {
        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $settings->fill($data);
            $settings->save();

            $this->callHook('afterSave');

            $this->sendSuccessNotification('Configuración de localizacion guardada.');

            $this->redirect(static::getUrl(), navigate: FilamentView::hasSpaMode() && is_app_url(static::getUrl()));
        } catch (\Throwable $th) {
            $this->sendErrorNotification('Failed to update settings. ' . $th->getMessage());
            throw $th;
        }
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
        return 'Localización';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Localización';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Localización';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Localización';
    }
}
