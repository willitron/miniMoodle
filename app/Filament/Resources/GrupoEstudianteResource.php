<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoEstudianteResource\Pages;
use App\Filament\Resources\GrupoEstudianteResource\RelationManagers;
use App\Models\Grupo_Estudiante;
use App\Models\GrupoEstudiante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupoEstudianteResource extends Resource
{
    protected static ?string $model = Grupo_Estudiante::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Grupo De Estudiantes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grupo_id')
    ->relationship('grupo', 'nombre')
    ->required(),

Forms\Components\Select::make('estudiante_id')
    ->relationship('estudiante', 'nombre')
    ->required(),

Forms\Components\Toggle::make('es_jefe')->label('¿Es jefe de grupo?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grupo.nombre')->label('Grupo'),
Tables\Columns\TextColumn::make('estudiante.nombre')->label('Estudiante'),
Tables\Columns\IconColumn::make('es_jefe')
    ->boolean()
    ->label('Jefe de grupo'),
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
            'index' => Pages\ListGrupoEstudiantes::route('/'),
            'create' => Pages\CreateGrupoEstudiante::route('/create'),
            'edit' => Pages\EditGrupoEstudiante::route('/{record}/edit'),
        ];
    }
}
