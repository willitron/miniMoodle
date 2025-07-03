<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Grupo_Estudiante extends Model
{

    protected $fillable = ['grupo_id', 'estudiante_id', 'es_jefe'];


//! por si el alumno se le agrega al mismo grupo de nuevo
    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         $exists = self::where('grupo_id', $model->grupo_id)
    //             ->where('estudiante_id', $model->estudiante_id)
    //             ->exists();

    //         if ($exists) {
    //             throw ValidationException::withMessages([
    //                 'estudiante_id' => 'Este estudiante ya está asignado a este grupo.',
    //             ]);
    //         }
    //     });
    // }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}
