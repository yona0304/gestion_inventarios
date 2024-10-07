<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionEquipo extends Model
{
    use HasFactory;

    protected $table = 'asignacion_equipo';

    protected $fillable = [
        'producto_id',
        'vehiculo_id',
        'usuario_id',
        'fecha_asignacion',
        'observaciones',
        'estado',
        'ubicacion'
    ];

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
