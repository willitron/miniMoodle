<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntregaResource\Pages;
use App\Filament\Resources\EntregaResource\RelationManagers;
use App\Models\Entrega;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntregaResource extends Resource
{
    protected static ?string $model = Entrega::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tarea_id')
                    ->relationship('tarea', 'titulo')
                    ->required(),

                Forms\Components\Select::make('estudiante_id')
                 ->relationship('estudiante', 'nombre')
                 ->required(),

                Forms\Components\DateTimePicker::make('fecha_entrega')
                ->default(now())
                ->disabled()
                ->required(),

                Forms\Components\RichEditor::make('documento')
                ->required()
                ->columnSpanFull(),

                Forms\Components\Textarea::make('comentario_docente'),

                Forms\Components\TextInput::make('calificacion')->numeric()->minValue(0)->maxValue(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tarea.titulo')->label('Tarea'),
                Tables\Columns\TextColumn::make('estudiante.nombre')->label('Estudiante'),
                Tables\Columns\TextColumn::make('calificacion'),
                Tables\Columns\TextColumn::make('fecha_entrega')->dateTime(),
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
            'index' => Pages\ListEntregas::route('/'),
            'create' => Pages\CreateEntrega::route('/create'),
            'edit' => Pages\EditEntrega::route('/{record}/edit'),
        ];
    }
}
