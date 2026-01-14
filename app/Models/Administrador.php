<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'permisos',
        'fecha_creacion'
    ];

    protected $casts = [
        'permisos' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

