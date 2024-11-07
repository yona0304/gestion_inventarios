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
        'fecha_devolucion',
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

    public function scopeAsignar($query, $BusProducto = '', $BusProfesional = '', $BusFecha = '', $BusUbicacion = '', $BusEstado = '', $BusDevolucion = '')
    {

        return $query->where(function ($query) use ($BusProducto, $BusProfesional, $BusFecha, $BusUbicacion, $BusEstado, $BusDevolucion) {
            if (!empty($BusProducto)) {
                $query->whereHas('producto', function ($query) use ($BusProducto) {
                    $query->where('codigo_interno', 'like', "%$BusProducto%");
                })
                ->orWhereHas('vehiculo', function ($query) use ($BusProducto) {
                    $query->where('placa', 'like', "%$BusProducto%");
                });
            }

            if (!empty($BusProfesional)) {
                $query->whereHas('usuario', function ($query) use ($BusProfesional) {
                    $query->where('nombres', 'like', "%$BusProfesional%");
                });
            }

            if (!empty($BusFecha)) {
                $query->whereDate('fecha_asignacion', '=', $BusFecha);
            }

            if (!empty($BusUbicacion)) {
                $query->where('ubicacion', 'like', "%$BusUbicacion%");
            }

            if (!empty($BusEstado)) {
                $query->where('estado', 'like', "%$BusEstado%");
            }

            if (!empty($BusDevolucion)) {
                $query->whereDate('fecha_devolucion', '=', $BusDevolucion);
            }
        });
    }
}
