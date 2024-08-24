<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NotificacionResource\Forms\NotificacionForm;
use App\Filament\Admin\Resources\NotificacionResource\Pages;
use App\Models\Notificacion;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NotificacionResource extends Resource
{
    protected static ?string $model = Notificacion::class;
    protected static ?string $pluralModelLabel = 'Notificaciones';
    protected static ?string $navigationIcon = 'tabler-walk';

    public static function form(Form $form): Form
    {
        return $form->schema(NotificacionForm::form())->columns(3);
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
                // Tables\Actions\Action::make('evaluar')->url(fn(Notificacion $record) => Pages\EvaluarNotificacion::getUrl(['record' => $record])),
                Tables\Actions\Action::make('scat')->url(fn(Notificacion $record) => Pages\ScatNotificacion::getUrl(['record' => $record])),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
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
            'view' => Pages\ViewNotificacion::route('/{record}'),
            'scat-notificacion' => Pages\ScatNotificacion::route('/{record}/scat'),
        ];
    }
}
