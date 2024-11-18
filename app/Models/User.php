<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'identificacion',
        'cargo_id',
        'ubicacion',
        'ods',
        'rol',
        'estado',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cargos()
    {
        return $this->belongsTo(Cargos::class, 'cargo_id');
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
    public function historialProductos()
    {
        return $this->hasMany(HistorialComputo::class);
    }

    // Relación con paz y salvo
    public function pazSalvo()
    {
        return $this->hasMany(PazSalvo::class);
    }

    // Relación con alquiler de equipo
    public function alquileres()
    {
        return $this->hasMany(AlquilerEquipo::class);
    }
}
