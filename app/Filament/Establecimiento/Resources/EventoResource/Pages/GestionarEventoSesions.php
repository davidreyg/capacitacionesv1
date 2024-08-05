<?php

namespace App\Filament\Establecimiento\Resources\EventoResource\Pages;

use App\Filament\Establecimiento\Resources\EventoResource;
use App\Filament\Establecimiento\Resources\SesionResource\Pages\RegistrarSesionAsistencia;
use App\Models\Evento;
use App\Models\Sesion;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                // Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('asistencia')
                    ->icon('tabler-list-search')
                    ->visible(fn(Sesion $record) => static::can('attendance', $record))
                    ->url(fn(Sesion $record): string => RegistrarSesionAsistencia::getUrl(['record' => $record])),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('evento');
    }
}
