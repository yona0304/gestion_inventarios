<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialProducto extends Model
{
    use HasFactory;

    protected $table = 'historial_de_productos';

    protected $fillable = [
        'usuario_id',
        'producto_id',
        'descripcion',
        'estado'
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
