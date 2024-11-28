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
        $dotacion = Dotaciones::with('cargos', 'categoria')
            ->Dota(
                $request->BusDota
            )
            ->paginate(6);

        if ($request->ajax()) {
            return view('partials.dotaciones', compact('dotacion'))->render();
        }

        return view('registrarDotacion', compact('categoria', 'cargo', 'dotacion'));
    }

    public function store(Request $request)
    {
        $cargo = $request->cargo;
        $categoria = $request->categorias;
        $request->validate([
            'cargo' => 'required|integer',
            'categorias' => 'required|integer',
        ]);

        $dotaActiva = Dotaciones::where('id_cargo', $cargo)
            ->where('id_activo', $categoria)
            ->exists();

        if ($dotaActiva) {

            return response()->json(['fail' => 'Dotación ya esta registrado'], 400);
        };

        Dotaciones::create([
            'id_cargo' => $cargo,
            'id_activo' => $categoria
        ]);

        return response()->json(['success' => 'Dotación Registrado']);
    }

    public function destroy($cargo, $categoria)
    {
        // buscamos la categoria por la el id, atraves de un json y js
        $DotacionSeleccionada = Dotaciones::where('id_cargo', $cargo)->where('id_activo', $categoria)
            ->first();

        // Si la dotacion existe, lo elimina de la base de datos
        if ($DotacionSeleccionada) {
            $DotacionSeleccionada->delete();
            // Retorna una respuesta en JSON indicando el éxito de la operación
            return response()->json(['success' => true, 'message' => 'Eliminación de dotacion exitosa.']);
            // return response()->json(['success' => 'Eliminación de categoria exitoso']);
        }

        return response()->json(['success' => false, 'message' => 'Dotacion no encontrada.'], 404);
    }
}
