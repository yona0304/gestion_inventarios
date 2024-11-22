<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialComputo extends Model
{
    use HasFactory;

    protected $table = 'historial_computo';

    protected $fillable = [
        'producto_id',
        'marca',
        'modelo',
        'hostname',
        't_equipo',
        'serial',
        'procesador',
        'disco',
        'ram',
        's_instalado',
        'licencias',
        's_operativo',
        'licencia',
        'antivirus',
        'version_licencia',
        'observaciones',
        'fecha_registro',
        'estado'
    ];

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function scopeEquipo($query, $Equipo = '', $FechaHistorial = '')
    {
        return $query->where(function ($query) use ($Equipo, $FechaHistorial) {
            if (!empty($Equipo)) {
                $query->whereHas('producto', function ($query) use ($Equipo) {
                    $query->where('codigo_interno', 'like', "%$Equipo%");
                });
            }

            if (!empty($FechaHistorial)) {
                $query->whereDate('fecha_registro', '=', $FechaHistorial);
            }
        });
    }
}
