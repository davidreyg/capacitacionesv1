<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolicitudResource\Pages;
use App\Filament\Resources\SolicitudResource\RelationManagers;
use App\Models\Solicitud;
use App\States\Solicitud\Aprobado;
use App\States\Solicitud\Evaluado;
use App\States\Solicitud\Habilitado;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SolicitudResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Solicitud::class;
    protected static ?string $pluralModelLabel = 'Solicitudes';
    protected static ?string $navigationIcon = 'tabler-folder-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('capacitacion_id')
                    ->relationship('capacitacion', 'nombre', fn(Builder $query) => $query->where('activo', true))
                    ->required(),
                Select::make('establecimiento_id')
                    ->default(auth()->user()->establecimiento_id)
                    ->relationship('establecimiento', 'nombre')
                    ->required(),
                Hidden::make('estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('capacitacion.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('establecimiento.nombre')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Solicitud $record): string => $record->estado->display())
                    ->color(fn(Solicitud $record): string => $record->estado->color())
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Action::make('Aprobar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Aprobar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Aprobado::class) && auth()->user()->can('transition_solicitud'))
                    ->color('info')
                    ->icon('tabler-file-like')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Aprobado::class)),
                Action::make('Habilitar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Habilitar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Habilitado::class) && auth()->user()->can('transition_solicitud'))
                    ->color('success')
                    ->icon('tabler-file-smile')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Habilitado::class)),
                Action::make('Evaluar')
                    ->hiddenLabel()
                    ->iconSize(IconSize::Large)
                    ->tooltip('Evaluar')
                    ->visible(fn(Solicitud $record): bool => $record->estado->canTransitionTo(Evaluado::class) && auth()->user()->can('transition_solicitud'))
                    ->color('danger')
                    ->icon('tabler-file-dislike')
                    ->requiresConfirmation()
                    ->action(fn(Solicitud $record): string => $record->estado->transitionTo(Evaluado::class)),
                Tables\Actions\DeleteAction::make()->hiddenLabel()->iconSize(IconSize::Large),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('super_admin')
            ? parent::getEloquentQuery()
            : parent::getEloquentQuery()->where('establecimiento_id', auth()->user()->establecimiento_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSolicituds::route('/'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
            'transition',
        ];
    }
}
