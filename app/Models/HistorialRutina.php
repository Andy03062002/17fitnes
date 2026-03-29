<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialRutina extends Model
{
    protected $table = 'historial_rutinas';

    protected $fillable = [
        'rutina_id',
        'prompt_usado',
        'respuesta_ia',
        'fecha_generacion'
    ];

    public $timestamps = false;

    public function rutina()
    {
        return $this->belongsTo(Rutina::class);
    }
}
