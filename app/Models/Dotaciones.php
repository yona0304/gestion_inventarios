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
        return $this->hasMany(Categoria::class);
    }
    public function cargos()
    {
        return $this->hasMany(Cargos::class);
    }
}
