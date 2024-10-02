<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class RegistrarProducto extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('registrarProducto', compact('categorias'));
    }

    public function store(Request $request)
    {
        //
        $estado = "Disponible";
        $request->validate([
            'categoria' => 'required|string',
            'codigo_interno' => 'required|string',
            'descripcion' => 'required|string',
            'codigo_referencia' => 'nullable|string',
            'observacion' => 'nullable|string',
        ]);

        $data = [
            'categoria_id' => $request->categoria,
            'codigo_interno' => $request->codigo_interno,
            'descripcion_equipo' => $request->descripcion,
            'codigo_equipo_referencia' => $request->codigo_referencia,
            'estado' => $estado
        ];

        if ($request->filled('observacion')) {
            $data['observaciones'] = $request->observacion;
        }

        Producto::create($data);
    }
}
