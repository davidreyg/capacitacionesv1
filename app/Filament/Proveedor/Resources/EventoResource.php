<?php

namespace App\Filament\Proveedor\Resources;

use App\Filament\Proveedor\Resources\EventoResource\Pages;
use App\Filament\Proveedor\Resources\EventoResource\RelationManagers;
use App\Models\Evento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventoResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Evento::class;
    // protected static ?string $modelLabel = 'Mis Eventos';
    protected static ?string $pluralModelLabel = 'Mis Eventos';
    protected static ?string $navigationIcon = 'tabler-calendar-event';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function canAccess(): bool
    {
        return auth()->user()->can('view_own_evento');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('capacitacion.nombre')
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lugar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vacantes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->formatStateUsing(fn(Evento $record): string => $record->estado->display())
                    ->color(fn(Evento $record): string => $record->estado->color()),
                Tables\Columns\TextColumn::make('modalidad_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                // ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventos::route('/'),
            // 'create' => Pages\CreateEvento::route('/create'),
            'view' => Pages\ViewEvento::route('/{record}'),
            // 'edit' => Pages\EditEvento::route('/{record}/edit'),
            // 'criterios-evaluacion' => Pages\GestionarEventoCriterioEvaluaciones::route('/{record}/criterios-evaluacion'),
            'evaluaciones' => Pages\GestionarEventoEvaluacions::route('/{record}/evaluaciones'),

            // Showcase of relations using Relationship Pages
            'sesions' => Pages\GestionarEventoSesions::route('/{record}/sesions'),
            // Showcase of create child pages
            // 'sesions.create' => Pages\CreateEventoSesion::route('/{record}/sesions/create'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewEvento::class,
            Pages\GestionarEventoSesions::class,
            Pages\GestionarEventoEvaluacions::class,
        ]);
    }

    public static function getAncestor(): ?Ancestor
    {
        return null;
    }
}
