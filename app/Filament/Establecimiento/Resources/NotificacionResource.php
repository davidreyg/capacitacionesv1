<?php

namespace App\Filament\Establecimiento\Resources;

use App\Enums\Notificacion\TipoAfectacion;
use App\Enums\Notificacion\TipoNotificacion;
use App\Filament\Admin\Resources\NotificacionResource\Forms\NotificacionForm;
use App\Filament\Establecimiento\Resources\NotificacionResource\Pages;
use App\Filament\Establecimiento\Resources\NotificacionResource\RelationManagers;
use App\Models\Empleado;
use App\Models\Notificacion;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificacionResource extends Resource
{
    protected static ?string $model = Notificacion::class;
    protected static ?string $pluralModelLabel = 'Notificaciones';
    protected static ?string $navigationIcon = 'tabler-walk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(NotificacionForm::form())
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')->wrap(),
                TextColumn::make('fecha')->date(),
                TextColumn::make('tipo_notificacion')->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromAuthEstablecimientoThroughEmpleado();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotificacions::route('/'),
            'create' => Pages\CreateNotificacion::route('/create'),
            'edit' => Pages\EditNotificacion::route('/{record}/edit'),
        ];
    }
}
