<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluacionResource\Pages;
use App\Filament\Resources\EvaluacionResource\RelationManagers;
use App\Models\Evaluacion;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluacionResource extends Resource
{
    use NestedResource;
    protected static ?string $model = Evaluacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('nombre')
                //     ->required()
                //     ->maxLength(100),
                // Forms\Components\TextInput::make('descripcion')
                //     ->maxLength(200),
                // Forms\Components\TextInput::make('valor')
                //     ->required()
                //     ->numeric()
                //     ->minValue(0.1)
                //     ->maxValue(90.80)
                //     ->mask('99.99')
                //     ->placeholder('##.##')
                //     ->suffix('%')
                //     ->live(true)
                //     ->hint(new HtmlString(Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading wire:target="data.porcentaje" />')))
                //     ->afterStateUpdated(function (Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $component) {
                //         $livewire->validateOnly($component->getStatePath());
                //     })
                //     ->rules([
                //         // fn(?Evaluacion $record): Closure => function (string $attribute, $value, Closure $fail) use ($record) {
                //         //    return new ValidarPorcentajesEvaluacion($record->evento_id, $record->id);
                //         // },
                //         fn(?Evaluacion $record) => new ValidarPorcentajesEvaluacion($record->evento_id, $record->id)
                //     ], fn(?Evaluacion $record) => !!$record),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('porcentaje')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evento_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            // 'index' => Pages\ListEvaluacions::route('/'),
            // 'create' => Pages\CreateEvaluacion::route('/create'),
            // 'edit' => Pages\EditEvaluacion::route('/{record}/edit'),
        ];
    }

    public static function getAncestor(): ?Ancestor
    {
        return Ancestor::make(
            'evaluacions',
            'evento',
        );
    }
}
