<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Dotaciones;
use App\Models\Cargos;
use Illuminate\Http\Request;

class DotaRegistroController extends Controller
{
    public function index(Request $request)
    {

        $categoria = Categoria::all();
        $cargo = Cargos::all();
        $BusDota = Dotaciones::Dota($request->BusDota)->paginate(6);
        if ($request->ajax()) {
            return view('partials.dotaciones', compact('dotacion'))->render();
        }

        $dotacion = Dotaciones::all();
        return view('registrarDotacion', compact('categoria','cargo','dotacion','BusDota'));
    }
    public function store(Request $request)
    {

        $cargo = $request->cargo;
        $categoria = $request->categorias;
        $request->validate([
            'cargo' => 'required|integer',
            'categorias' => 'required|integer',
        ]);
        Dotaciones::create([
            'id_cargo' => $cargo,
            'id_activo' => $categoria
        ]);

        return response()->json(['success' => 'Categoria Registrado']);
    }
}
