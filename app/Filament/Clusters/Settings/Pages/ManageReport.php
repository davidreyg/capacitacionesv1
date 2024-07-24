<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Enums\Setting\Font;
use App\Filament\Clusters\Settings;
use App\Settings\GeneralSettings;
use App\Settings\ReportSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
    use HasPageShield;
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
                TextInput::make('sub_header')
                    ->live()
                    ->nullable(),
                Textarea::make('terms')
                    ->live()
                    ->nullable(),
                Textarea::make('footer')
                    ->live()
                    ->nullable(),
                Select::make('font')
                    ->label('Tipo de letra')
                    ->allowHtml()
                    ->native(false)
                    ->options(
                        collect(Font::cases())
                            ->mapWithKeys(static fn($case) => [
                                $case->value => "<span style='font-family:{$case->getLabel()}'>{$case->getLabel()}</span>",
                            ]),
                    ),
                // TODO: Mejorar el formato de image para cropear o ajustar.
                FileUpload::make('logo')
                    ->openable()
                    ->maxSize(1024)
                    ->visibility('public')
                    ->disk('public')
                    ->directory('logos/document')
                    ->imageResizeMode('contain')
                    ->imageCropAspectRatio('3:2')
                    ->panelAspectRatio('3:2')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('center bottom')
                    ->uploadButtonPosition('center bottom')
                    ->uploadProgressIndicatorPosition('center bottom')
                    // ->getUploadedFileNameForStorageUsing(
                    //     static fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                    //         ->prepend(Auth::user()->currentCompany->id . '_'),
                    // )
                    ->extraAttributes([
                        'class' => 'aspect-[3/2] w-[9.375rem] max-w-full',
                    ])
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/gif']),
            ])->columns();
    }

    // TODO: Generar iframe para mostrar el pdf!
    protected function getTemplateSection(): Component
    {
        return Section::make('Template')
            ->description('Configure su template para los reportes.')
            ->schema([
                // ViewField::make('preview.default')
                //     // ->columnSpanFull()
                //     ->hiddenLabel()
                //     // ->visible(static fn(Get $get) => $get('template') === 'default')
                //     ->view('livewire.reporte-asistencia')
                //     ->viewData([
                //         'logo' => \Storage::url(app(ReportSettings::class)->logo),
                //         'data' => ['hola ', 'xdxd']
                //     ]),
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
