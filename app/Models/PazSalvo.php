<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PazSalvo extends Model
{
    use HasFactory;

    protected $table = 'paz_salvo';

    protected $fillable = [
        'usuario_id',
        'producto_id',
        'contabilidad',
        'recurso_humano'
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
