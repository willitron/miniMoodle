<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'ci',
        'foto',
        'correo',
    ];

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
