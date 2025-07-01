<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
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
        return $this->belongsToMany(Grupo::class, 'grupo_estudiantes')
                    ->withPivot('es_jefe')
                    ->withTimestamps();
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
