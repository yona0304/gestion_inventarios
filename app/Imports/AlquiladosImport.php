<?php

namespace App\Imports;

use App\Models\AlquilerEquipo;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlquiladosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $duplicados = [];

    public function getCsvSettings(): array
    {
        return [
            'delimitar' => ';',
        ];
    }

    public function model(array $row)
    {
        $IdUsuario = $row['profesional']; // Cambia 'Profesional' a 'profesional' si es necesario

        // dd($row);

        // Busca el usuario utilizando el ID del profesional
        $SelecIdIdentificacion = User::where('identificacion', $IdUsuario)
            ->where('estado', 'Activo')
            ->first();


        // Verifica si se encontró un usuario activo
        if ($SelecIdIdentificacion) {
            AlquilerEquipo::create([
                'tipo_producto' => $row['tipo'],
                'producto' => $row['descripcion'],
                'valor_contratado' => $row['valor'],
                'ubicacion' => $row['ubicacion'],
                'usuario_id' => $SelecIdIdentificacion->id, // Almacena el ID del usuario
                'fecha_inicio_alquiler' => $row['fecha'],
            ]);
        }

        return null;
    }
}
