<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo_Estudiante extends Model
{

    protected $fillable = ['grupo_id', 'estudiante_id', 'es_jefe'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
