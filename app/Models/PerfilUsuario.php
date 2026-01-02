<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model

{
    
    public $timestamps = false; // 👈 Desactiva created_at y updated_at
    protected $table = 'perfiles_usuario';

    protected $fillable = [
        'user_id',
        'edad',
        'peso',
        'altura',
        'genero',
        'somatotipo',
        'nivel_actividad',
        'objetivo',
        'disponibilidad_dias',
        'minutos_por_dia',
        'lesiones',
        'experiencia',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
