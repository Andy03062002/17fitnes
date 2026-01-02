<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $table = 'visitantes';

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'correo',
        'telefono',
        'ciudad',
        'peso',
        'altura',
        'nivel_actividad',
        'objetivo',
        'experiencia',
        'dias_disponibles',
        'minutos_por_dia',
        'grupo_muscular',
        'nivel_dificultad'
    ];

    public $timestamps = true;
}
