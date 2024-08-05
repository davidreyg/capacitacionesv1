<?php

namespace App\Filament\Proveedor\Resources\EventoResource\Pages;

use App\Filament\Proveedor\Resources\EventoResource;
use App\Models\Sesion;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GestionarEventoSesions extends ManageRelatedRecords
{
    use NestedPage;
    use NestedRelationManager;
    protected static string $resource = EventoResource::class;
    protected ?string $heading = 'Sesiones';
    protected static ?string $breadcrumb = 'Sesiones';
    protected static string $relationship = 'sesions';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Sesiones';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('subirRecursos')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->visible(fn(Sesion $record) => static::can('subirRecursos', $record))
                    ->fillForm(fn(Sesion $record): array => [
                        'media' => $record->getMediaCollection('recursos'),
                    ])
                    ->form([
                        SpatieMediaLibraryFileUpload::make('media')
                            ->hiddenLabel()
                            ->collection('recursos')
                            ->multiple()
                            ->maxFiles(3)
                            ->alignCenter()
                            ->columnSpanFull(),
                    ])
                    ->modalSubmitActionLabel('Guardar')
                    ->databaseTransaction()
                    ->action(function (Action $action, array $data, Sesion $record): void {
                        $record->save();
                        Notification::make()->success()->title('Guardado')->send();
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('evento');
    }
}
