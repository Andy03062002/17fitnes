<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleRutina extends Model
{
    protected $table = 'detalles_rutina';

    protected $fillable = [
        'rutina_id',
        'ejercicio_id',
        'series',
        'repeticiones',
        'descanso_segundos',
        'dia'
    ];

    public $timestamps = false;
}

