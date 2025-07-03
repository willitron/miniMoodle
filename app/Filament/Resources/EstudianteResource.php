<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Filament\Resources\EstudianteResource\RelationManagers;
use App\Models\Estudiante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationBadgeTooltip = 'Estudiantes Registrados';

    protected static ?string $navigationGroup = 'Administracion Estudiantes';

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\TextInput::make('apellido_paterno')->required(),
                Forms\Components\TextInput::make('apellido_materno')->required(),
                Forms\Components\TextInput::make('telefono')->required(),
                Forms\Components\TextInput::make('ci')->required(),
                Forms\Components\FileUpload::make('foto'),
                Forms\Components\TextInput::make('correo')->email()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('apellido_paterno')->searchable(),
                Tables\Columns\TextColumn::make('apellido_materno')->searchable(),
                Tables\Columns\TextColumn::make('telefono')->searchable(),
                Tables\Columns\TextColumn::make('ci')->searchable(),
                Tables\Columns\TextColumn::make('correo')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/create'),
            'edit' => Pages\EditEstudiante::route('/{record}/edit'),
        ];
    }

}
