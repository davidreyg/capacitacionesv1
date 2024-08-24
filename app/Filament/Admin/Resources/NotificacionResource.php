<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Notificacion\TipoNotificacion;
use App\Filament\Admin\Resources\NotificacionResource\Forms\NotificacionForm;
use App\Filament\Admin\Resources\NotificacionResource\Pages;
use App\Models\Notificacion;
use App\States\Notificacion\Verificado;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NotificacionResource extends Resource implements HasShieldPermissions
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
                // TextColumn::make('tipo_notificacion')->badge(),
                TextColumn::make('tipo_notificacion_verificado')
                    ->label('Tipo de Notificacion (*)')
                    ->visible(fn($state) => !!$state)
                    ->badge(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Notificacion $record): string => $record->estado->display())
                    ->color(fn(Notificacion $record): string => $record->estado->color()),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('verificar')
                    ->visible(fn(Notificacion $record): bool => $record->estado->canTransitionTo(Verificado::class, null))
                    ->modalWidth(MaxWidth::Medium)
                    ->requiresConfirmation()
                    ->form([
                        Select::make('tipo_notificacion_verificado')
                            ->label('Tipo de Notificacion')
                            ->options(TipoNotificacion::toArray())
                            ->required(),
                    ])
                    ->modalSubmitActionLabel('Verificar')
                    ->databaseTransaction()
                    ->action(
                        function (array $data, Notificacion $record) {
                            $record->estado->transitionTo(Verificado::class, $data['tipo_notificacion_verificado']);
                            Notification::make()
                                ->success()
                                ->title('Exito!')
                                ->body('Verificado correctamente.')
                                ->send();
                        }
                    ),
                Tables\Actions\Action::make('scat')
                    ->visible(fn(Notificacion $record) => static::can('evaluarScat', $record))
                    ->url(fn(Notificacion $record) => Pages\ScatNotificacion::getUrl(['record' => $record])),
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

    public static function getPermissionPrefixes(): array
    {
        return array_merge(
            config('filament-shield.permission_prefixes.resource'),
            [
                'evaluar_scat',
            ]
        );
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
