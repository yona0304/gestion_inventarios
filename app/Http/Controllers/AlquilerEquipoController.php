<?php

namespace App\Http\Controllers;

use App\Models\AlquilerEquipo;
use App\Models\User;
use Illuminate\Http\Request;

class AlquilerEquipoController extends Controller
{
    public function index()
    {
        $usuarios = User::where('estado', 'Activo')->get(['nombres', 'identificacion']);

        $selecId = $usuarios->pluck('identificacion')->toArray();

        return view('alquilerEquipo', compact('selecId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_equipo' => 'required|string',
            'descripcion_equipo' => 'required|string',
            'valor_contratado' => 'required|numeric',
            'profesional' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_inici_alquiler' => 'required|date'
        ]);

        // $tipoEquipo = strtoupper($request->tipo_equipo);
        $usuario = User::where('identificacion', $request->profesional)->first();

        if (!$usuario) {
            // Si el profesional no existe, retorna una respuesta con un mensaje de alerta.
            return response()->json(['success' => false, 'message' => 'Profesional no registrado en el sistema.'], 404);
        }

        // Si el profesional existe, realiza el registro de alquiler.
        AlquilerEquipo::create([
            'tipo_producto' => $request->tipo_equipo,
            'producto' => $request->descripcion_equipo,
            'valor_contratado' => $request->valor_contratado,
            'ubicacion' => $request->ubicacion,
            'usuario_id' => $usuario->id,
            'fecha_inicio_alquiler' => $request->fecha_inici_alquiler,
        ]);

        return response()->json(['success' => 'Registro de alquiler realizado.']);

        return response()->json(['success' => false, 'message' => 'No es posible continuar con la operación.'], 404);
    }

}
