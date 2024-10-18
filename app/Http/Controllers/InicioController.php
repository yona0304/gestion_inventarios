<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
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

        return view('inicio', [
            'ciudades' => $ciudades,
            'series' => $series
        ]);
    }
    /* public function datosInv()
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
                $data[] = $cantidad ? $cantidad->total : 0; // Si no hay productos en esa ciudad, ponemos 0
            }

            $series[] = [
                'name' => $nombre,
                'data' => $data
            ];
        }

        return view('inicio', [
            'ciudades' => $ciudades,
            'series' => $series
        ]);


    } */
}
