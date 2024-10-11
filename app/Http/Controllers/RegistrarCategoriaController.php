<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class RegistrarCategoriaController extends Controller
{
    public function index(Request $request)
    {
        $selectCategoria = Categoria::Catego($request->BusCategoria)->paginate(5);

        if ($request->ajax()) {
            return view('partials.categorias', compact('selectCategoria'))->render();
        }

        return view('categoria', compact('selectCategoria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string',
            'prefijo' => 'required|string',
            // 'cantidad' => 'required|numeric'
        ]);

        $categorias = strtoupper($request->categoria);
        $prefijos = strtoupper($request->prefijo);

        Categoria::create([
            'nombre_categoria' => $categorias,
            // 'contador' => $request->cantidad,
            'prefijo' => $prefijos
        ]);

        return response()->json(['success' => 'Categoria Registrado']);
    }
}
