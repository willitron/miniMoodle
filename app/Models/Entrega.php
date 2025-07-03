<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{

    protected $fillable = [
      'tarea_id',
      'estudiante_id',
      'fecha_entrega',
      'documento',
      'entregado',
      'comentario_docente',
      'calificacion',
    ];
    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
