<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotaciones extends Model
{
    use HasFactory;

    protected $table = 'dotacion';

    protected $fillable = [
        'id_cargo',
        'id_activo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_activo');
    }
    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'id_cargo');
    }

    public function scopeDota($query, $BusDota = '')
    {
        return $query->where(function ($query) use ($BusDota) {
            $query->whereHas('cargos', function ($query) use ($BusDota) {
                $query->where('cargo', 'like', "%$BusDota%");
            });
        });
    }
}
