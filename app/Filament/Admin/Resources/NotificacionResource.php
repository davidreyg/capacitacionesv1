<?php

namespace App\Filament\Admin\Resources;

use App\Enums\Notificacion\TipoNotificacion;
use App\Filament\Admin\Resources\NotificacionResource\Forms\NotificacionForm;
use App\Filament\Admin\Resources\NotificacionResource\Pages;
use App\Filament\Admin\Resources\NotificacionResource\Table\NotificacionTable;
use App\Models\Notificacion;
use App\States\Notificacion\Verificado;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Pages\SubNavigationPosition;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;

class NotificacionResource extends Resource implements HasShieldPermissions
{
    use NestedResource;

    protected static ?string $model = Notificacion::class;
    protected static ?string $pluralModelLabel = 'Notificaciones';
    protected static ?string $navigationIcon = 'tabler-walk';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form->schema(NotificacionForm::form())->columns(3);
    }

    public static function canAccess(): bool
    {
        return static::canViewAny() || static::can('verVerificados');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                NotificacionTable::columns()
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('anexoUno')
                    // ->visible(fn(Notificacion $record) => static::can('evaluarScat', $record))
                    ->url(fn(Notificacion $record) => Pages\RegistrarAnexoUno::getUrl(['record' => $record])),
                Tables\Actions\Action::make('verificar')
                    ->visible(fn(Notificacion $record): bool => $record->estado->canTransitionTo(Verificado::class, null))
                    ->modalWidth(MaxWidth::Medium)
                    ->color(fn(Notificacion $record): string => (new Verificado($record))->color())
                    ->icon(fn(Notificacion $record): string => (new Verificado($record))->icon())
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
                'ver_verificados',
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
            'anexo-uno' => Pages\RegistrarAnexoUno::route('/{record}/anexo-uno'),
            'registro_accidente' => Pages\RegistroAccidente::route('/{record}/registro-accidente'),
            'declaracions' => Pages\GestionarNotificacionDeclaraciones::route('/{record}/declaracions'),
            'declaracions.create' => Pages\CreateNotificacionDeclaracion::route('/{record}/declaracions/create'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
                // Pages\EditNotificacion::class,
            Pages\ViewNotificacion::class,
            Pages\GestionarNotificacionDeclaraciones::class,
            Pages\RegistrarAnexoUno::class,
            Pages\RegistroAccidente::class,
        ]);
    }

    // FIXME: Esto va a cambiar porque querre ver los estados verificado en adelante.
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (static::can('viewAny')) {
            return $query;
        }

        if (static::can('verVerificados')) {
            $query
                ->where('tipo_notificacion_verificado', TipoNotificacion::ACCIDENTE)
                ->whereState('estado', Verificado::class);
        }

        return $query;
    }

    public static function getAncestor(): ?Ancestor
    {
        return null;
    }
}
