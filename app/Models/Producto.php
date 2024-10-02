<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'codigo_interno',
        'descripcion_equipo',
        'codigo_equipo_referencia',
        'observaciones',
        'estado'
    ];

    // Relación con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con asignación de equipo
    public function asignaciones()
    {
        return $this->hasMany(AsignacionEquipo::class);
    }

    // Relación con novedades
    public function novedades()
    {
        return $this->hasMany(Novedad::class);
    }

    // Relación con historial de productos
    public function historial()
    {
        return $this->hasMany(HistorialProducto::class);
    }

    // Relación con paz y salvo
    public function pazSalvo()
    {
        return $this->hasMany(PazSalvo::class);
    }
}
