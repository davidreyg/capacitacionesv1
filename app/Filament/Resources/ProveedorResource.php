<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProveedorResource\Pages;
use App\Filament\Resources\ProveedorResource\RelationManagers;
use App\Models\Proveedor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProveedorResource extends Resource
{
    protected static ?string $model = Proveedor::class;
    protected static ?string $navigationGroup = 'Mantenimiento';
    protected static ?string $pluralModelLabel = 'Proveedores';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo_documento_id')
                    ->relationship('tipo_documento', 'nombre')
                    ->required(),
                Forms\Components\TextInput::make('numero_documento')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->numeric()
                    ->minValue(0),
                Forms\Components\TextInput::make('razon_social')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->numeric()
                    ->minValue(0),
                Forms\Components\TextInput::make('correo')
                    ->email()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('fecha_alta')
                    ->date()
                    ->required(),
                Forms\Components\DatePicker::make('fecha_baja')->date(),
                Forms\Components\Toggle::make('is_active')
                    ->label('¿Activo?')
                    ->inline(false)
                    ->required(),
                Forms\Components\RichEditor::make('observacion')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipo_documento.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_documento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('razon_social')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Activo')
                    ->boolean(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('razon_social');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProveedors::route('/'),
        ];
    }
}
