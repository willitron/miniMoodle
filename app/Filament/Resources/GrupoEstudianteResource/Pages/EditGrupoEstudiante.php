<?php

namespace App\Filament\Resources\GrupoEstudianteResource\Pages;

use App\Filament\Resources\GrupoEstudianteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGrupoEstudiante extends EditRecord
{
    protected static string $resource = GrupoEstudianteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
