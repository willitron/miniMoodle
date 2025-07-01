<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{

    protected $fillable = ['docente_id', 'nombre'];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'grupo_estudiantes')
                    ->withPivot('es_jefe')
                    ->withTimestamps();
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
