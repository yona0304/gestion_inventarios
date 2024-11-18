<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'id',
        'nombre_categoria',
        'prefijo',
        'contador',
    ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function categoria()
    {
        return $this->hasMany(Categoria::class);
    }

    public function scopeCatego($query, $BusCategoria = '')
    {
        // return $query->where('id_producto', 'like', "%{$BusCategoria}%");

        return $query->where(function ($query) use ($BusCategoria) {
            $query->where('nombre_categoria', 'like', "%$BusCategoria%")
                ->orWhere('prefijo', 'like', "%$BusCategoria%");
        });
    }
}
