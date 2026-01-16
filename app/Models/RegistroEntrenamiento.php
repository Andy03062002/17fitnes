<?php
// app/Models/RegistroEntrenamiento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroEntrenamiento extends Model
{
    protected $table = 'registros_entrenamiento';
    
    protected $fillable = [
        'user_id',
        'fecha'
    ];
    
    protected $casts = [
        'fecha' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}