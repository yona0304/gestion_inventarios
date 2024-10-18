<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\AlquilerEquipo;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {

        // Obtener los productos y contarlos por ciudad
        $productosPorCiudad = Producto::select('ubicacion', 'categoria_id', DB::raw('count(*) as total'))
        ->groupBy('ubicacion', 'categoria_id')
        ->get();

        // Organizar los datos en un formato que Highcharts pueda usar
        $ciudades = $productosPorCiudad->pluck('ubicacion')->unique()->values()->all();
        $productos = $productosPorCiudad->groupBy('categoria_id');

        $series = [];

        foreach ($productos as $nombre => $productosCiudad) {
            $data = [];
            // Recorremos las ciudades y asignamos el número de productos para cada una
            foreach ($ciudades as $ciudad) {
                $cantidad = $productosCiudad->where('ubicacion', $ciudad)->first();
                $data[] = $cantidad ? $cantidad->total : null; // Si no hay productos en esa ciudad, ponemos 0
            }
            $name = Categoria::where('id', $nombre)
            ->pluck('nombre_categoria')
            ->first();

            $series[] = [
                'name' => $name,
                'data' => $data
            ];
        }

        $asignado = Producto::where('estado', 'Asignado')->count();
        $mantenimiento = Producto::where('estado', 'Mantenimiento')->count();
        $disponible = Producto::where('estado', 'Disponible')->count();

        $data = [
            ['name' => 'Asignado', 'y' => $asignado],
            ['name' => 'Mantenimiento', 'y' => $mantenimiento],
            ['name' => 'Disponible', 'y' => $disponible]
        ];

        $totalProductos = Producto::count();
        // Contar todos los alquileres
        $totalAlquileres = AlquilerEquipo::count();
        $dato2 = [
            ['name' => 'Alquilados', 'y' => $totalAlquileres],
            ['name' => 'Asignados', 'y' => $totalProductos]
        ];


        return view('inicio', [
            'ciudades' => $ciudades,
            'series' => $series,
            'data' => $data,
            'dato2' => $dato2,
        ]);
    }

   /*  public function prods() {
    // Contar todos los productos
    $totalProductos = Producto::count();
    // Contar todos los alquileres
    $totalAlquileres = AlquilerEquipo::count();
    $dato2 = [
        ['name' => 'Propios', 'y' => $totalAlquileres],
        ['name' => 'Alquilados', 'y' => $totalProductos]
    ];
    return view('inicio',
    ['prods' => $dato2]
    );

    } */
}
