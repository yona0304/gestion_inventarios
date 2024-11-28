<?php

namespace App\Imports;

use App\Models\HistorialComputo;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HistorialImport implements ToModel, WithHeadingRow
{
    protected $registros = [];

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
        ];
    }

    public function model(array $row)
    {
        // Buscar el producto por codigo_interno
        $producto = Producto::where('codigo_interno', $row['codigo_interno'])->first();

        // Si el producto existe, se guarda en el historial
        if ($producto) {
            return new HistorialComputo([
                'producto_id'       => $producto->id,  // Usamos el ID del producto encontrado
                'marca'             => $row['marca'] ?? null,
                'modelo'            => $row['modelo'] ?? null,
                'hostname'          => $row['hostname'] ?? null,
                't_equipo'          => $row['tipo_equipo'] ?? null,
                'serial'            => $row['serial'],
                'procesador'        => $row['procesador'] ?? null,
                'disco'             => $row['disco'] ?? null,
                'disco2'            => $row['disco_2'] ?? null,
                'ram'               => $row['ram'] ?? null,
                's_instalado'       => $row['software_instalado'] ?? null,
                'licencias'         => $row['licencias'] ?? null,
                's_operativo'       => $row['sistema_operativo'] ?? null,
                'licencia'          => $row['licencia'] ?? null,
                'antivirus'         => $row['antivirus'] ?? null,
                'version_licencia'  => $row['version_licencia'] ?? null,
                'observaciones'     => $row['observaciones'] ?? null,
                'fecha_registro'    => $row['fecha_registro'] ?? null,
                'estado'            => $row['estado'] ?? null,
            ]);
        }
        if (!$producto) {
            // Agrega a la lista de registros
            $this->registros[] = $row;
        }

        // Si no se encuentra el producto, simplemente no se guarda nada
        return null;
    }

    // Método para obtener los registros
    public function getRegistros()
    {
        return $this->registros;
    }
}
