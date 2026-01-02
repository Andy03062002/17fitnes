<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    protected $table = 'rutinas';

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'generada_por',
        'fecha_generacion'
    ];

    public $timestamps = false;

    public function historial()
    {
        return $this->hasMany(HistorialRutina::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleRutina::class);
    }
}

