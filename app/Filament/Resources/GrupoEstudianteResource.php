<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoEstudianteResource\Pages;
use App\Filament\Resources\GrupoEstudianteResource\RelationManagers;
use App\Models\Estudiante;
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

    protected static ?string $navigationGroup = 'Administracion Docentes';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grupo_id')
            ->relationship('grupo', 'nombre')
            ->required(),



    Forms\Components\Select::make('estudiante_id')
    ->label('Estudiante')
    ->options(function ($get) {
        $grupoId = $get('grupo_id');

        if (!$grupoId) {
            return []; // aún no se ha seleccionado el grupo
        }

        $asignados = Grupo_Estudiante::where('grupo_id', $grupoId)
            ->pluck('estudiante_id');

        return Estudiante::whereNotIn('id', $asignados)->pluck('nombre', 'id');
    })
    ->searchable()
    ->required()
    ->reactive(),



    Forms\Components\Toggle::make('es_jefe')
    ->onColor('success')
    // ->offColor('danger')
        ->label('¿Es jefe de grupo?'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grupo.nombre')
                ->label('Grupo'),

                Tables\Columns\TextColumn::make('estudiante.nombre')
                ->label('Estudiante')
                ->icon('heroicon-s-user'),

                Tables\Columns\TextColumn::make('estudiante.apellido_paterno')
                ->label('Apellido Paterno'),

                Tables\Columns\TextColumn::make('estudiante.apellido_materno')
                ->label('Apellido Materno'),

                Tables\Columns\TextColumn::make('estudiante.telefono')
                ->label('Teléfono')
                ->icon('heroicon-s-phone'),

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
    protected static function booted()
{
    static::creating(function ($model) {
        $exists = self::where('grupo_id', $model->grupo_id)
            ->where('estudiante_id', $model->estudiante_id)
            ->exists();

        if ($exists) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'estudiante_id' => 'Este estudiante ya está asignado a este grupo.',
            ]);
        }
    });
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
