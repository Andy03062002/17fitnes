<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    protected $table = 'ejercicios';

     public $timestamps = false; // ✅ CLAVE

    protected $fillable = [
        'nombre',
        'grupo_muscular_objetivo',
        'nivel_dificultad',
        'mecanica',
        'video_corto',
    ];

    /**
     * Relación con detalles de rutina
     */

}
