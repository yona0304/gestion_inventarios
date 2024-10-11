<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'color',
        'llave',
        'terpel',
        'placa',
        'descripcion_vehiculo',
        'traccion',
        'modelo',
        'proveedor_contratante',
        'tipo_proveedor',
        'valor_contratado',
        'fecha_entregaProveedor',
        'fecha_devolucionProveedor',
        'estado'
    ];


    public function asignaciones()
    {
        return $this->hasMany(AsignacionEquipo::class);
    }
}
