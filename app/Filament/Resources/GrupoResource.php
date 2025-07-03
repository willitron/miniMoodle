<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoResource\Pages;
use App\Filament\Resources\GrupoResource\RelationManagers;
use App\Models\Grupo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupoResource extends Resource
{
    protected static ?string $model = Grupo::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Administracion Docentes';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required(),
Forms\Components\Select::make('docente_id')
    ->label('Docente')
    ->relationship('docente', 'nombre')
    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable(),
Tables\Columns\TextColumn::make('docente.nombre')->label('Docente'),
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
            ])
            ->recordUrl(null);
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
            'index' => Pages\ListGrupos::route('/'),
            'create' => Pages\CreateGrupo::route('/create'),
            'edit' => Pages\EditGrupo::route('/{record}/edit'),
        ];
    }
}
