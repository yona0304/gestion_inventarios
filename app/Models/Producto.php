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
        'ubicacion',
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
        return $this->hasMany(HistorialComputo::class);
    }

    // Relación con paz y salvo
    public function pazSalvo()
    {
        return $this->hasMany(PazSalvo::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            // Asegurarse de que ya tiene un código interno asignado
            if (empty($producto->codigo_interno) && $producto->categoria_id) {
                $categoria = $producto->categoria;
                $prefijo = $categoria->prefijo;

                // Obtener el contador del objeto del producto
                $contador = request()->input('contador');

                // Formatear el contador (rellenar con ceros a la izquierda si es necesario)
                $contadorFormateado = str_pad($contador, 3, '0', STR_PAD_LEFT);

                // Crear el código interno único
                $producto->codigo_interno = $prefijo . $contadorFormateado;
            }
        });
    }

    public function scopeProduct($query, $BuProducto = '', $BuCategoria = '', $BuInterno = '', $BuEquipo = '', $BuUbicacion = '', $BuReferencia = '', $BuEstado = '')
    {

        return $query->where(function ($query) use ($BuProducto, $BuCategoria, $BuInterno, $BuEquipo, $BuUbicacion, $BuReferencia, $BuEstado) {
            if (!empty($BuProducto)) {
                $query->where('codigo_interno', 'like', "%$BuProducto%")
                    ->orWhere('codigo_equipo_referencia', 'like', "%$BuProducto%")
                    ->orWhere('descripcion_equipo', 'like', "%$BuProducto%");
            }

            if (!empty($BuCategoria)) {
                $query->whereHas('categoria', function ($query) use ($BuCategoria) {
                    $query->where('nombre_categoria', 'like', "%$BuCategoria%");
                });
            }

            if (!empty($BuInterno)) {
                $query->where('codigo_interno', 'like', "%$BuInterno%");
            }

            if (!empty($BuEquipo)) {
                $query->where('descripcion_equipo', 'like', "%$BuEquipo%");
            }

            if (!empty($BuUbicacion)) {
                $query->where('ubicacion', 'like', "%$BuUbicacion%");
            }

            if (!empty($BuReferencia)) {
                $query->where('codigo_equipo_referencia', 'like', "%$BuReferencia%");
            }

            if (!empty($BuEstado)) {
                $query->where('estado', 'like', "%$BuEstado%");
            }
        });
    }
}
