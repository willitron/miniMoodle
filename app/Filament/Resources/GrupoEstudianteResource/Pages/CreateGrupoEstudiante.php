<?php

namespace App\Filament\Resources\GrupoEstudianteResource\Pages;

use App\Filament\Resources\GrupoEstudianteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGrupoEstudiante extends CreateRecord
{
    protected static string $resource = GrupoEstudianteResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
