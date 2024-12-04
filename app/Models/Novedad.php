<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    use HasFactory;

    protected $table = 'novedades';

    protected $fillable = [
        'producto_id',
        'usuario_id',
        'descripcion',
        'fecha_novedad',
        'tipo_novedad',
        'estado'
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

    public function scopeNov($query, $BusNoveProducto = '', $BusNoveProfesional = '', $BusNoveFecha = '', $BusNoveTipo = '', $BusNoveEstado = '')
    {
        return $query->where(function ($query) use ($BusNoveProducto, $BusNoveProfesional, $BusNoveFecha, $BusNoveTipo, $BusNoveEstado) {
            // Filtro por producto o vehiculo
            if (!empty($BusNoveProducto)) {
                $query->where(function ($query) use ($BusNoveProducto) {
                    $query->whereHas('producto', function ($query) use ($BusNoveProducto) {
                        $query->where('codigo_interno', 'like', "%$BusNoveProducto%");
                    });
                });
            }

            if (!empty($BusNoveProfesional)) {
                $query->whereHas('usuario', function ($query) use ($BusNoveProfesional) {
                    $query->where('nombres', 'like', "%$BusNoveProfesional%");
                });
            }

            if (!empty($BusNoveFecha)) {
                $query->whereDate('fecha_novedad', '=', $BusNoveFecha);
            }

            if (!empty($BusNoveTipo)) {
                $query->where('tipo_novedad', 'like', "%$BusNoveTipo%");
            }

            if (!empty($BusNoveEstado)) {
                $query->where('estado', 'like', "%$BusNoveEstado%");
            }
        });
    }
}
