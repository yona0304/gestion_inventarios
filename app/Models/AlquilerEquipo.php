<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlquilerEquipo extends Model
{
    use HasFactory;

    protected $table = 'alquiler_equipo';

    protected $fillable = [
        'tipo_producto',
        'producto',
        'valor_contratado',
        'ubicacion',
        'usuario_id',
        'fecha_inicio_alquiler',
        'fecha_fin_alquiler'
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAlqui($query, $BuscarAlquiler = ''){
        return $query->where('identificacion', 'like', "%{$BuscarAlquiler}%");
    }
}
