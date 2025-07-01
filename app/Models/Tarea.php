<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{

    protected $fillable = [
        'titulo',
        'fecha_entrega',
        'descripcion',
        'grupo_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
