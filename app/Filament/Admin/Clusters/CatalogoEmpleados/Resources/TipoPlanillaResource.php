<?php

namespace App\Filament\Admin\Clusters\CatalogoEmpleados\Resources;

use App\Filament\Admin\Clusters\CatalogoEmpleados;
use App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\TipoPlanillaResource\Pages;
use App\Filament\Admin\Clusters\CatalogoEmpleados\Resources\TipoPlanillaResource\RelationManagers;
use App\Models\TipoPlanilla;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoPlanillaResource extends Resource
{
    protected static ?string $model = TipoPlanilla::class;
    protected static ?string $pluralModelLabel = 'Tipo de planillas';
    protected static ?string $modelLabel = 'tipo de planilla';
    protected static ?string $navigationIcon = 'tabler-certificate-2';

    protected static ?string $cluster = CatalogoEmpleados::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoPlanillas::route('/'),
        ];
    }
}
