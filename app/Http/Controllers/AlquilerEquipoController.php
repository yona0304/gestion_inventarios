<?php

namespace App\Http\Controllers;

use App\Imports\AlquiladosImport;
use App\Models\AlquilerEquipo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        if ($usuario) {

            AlquilerEquipo::create([
                'tipo_producto' => $request->tipo_equipo,
                'producto' => $request->descripcion_equipo,
                'valor_contratado' => $request->valor_contratado,
                'ubicacion' => $request->ubicacion,
                'usuario_id' => $usuario->id,
                'fecha_inicio_alquiler' => $request->fecha_inici_alquiler,
            ]);

            return response()->json(['success' => 'Registro de alquiler realizado.']);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró pudo realizar la operación, intentalo mas tarde'], 404);
    }

    public function list(Request $request)
    {
        $alquilados = AlquilerEquipo::Alqui($request->BuscarAlquiler)->join('users', 'alquiler_equipo.usuario_id', '=', 'users.id')
            ->select('alquiler_equipo.*', 'users.identificacion as identificacion')->orderBy('created_at', 'desc')
            ->paginate(5);

        if ($request->ajax()) {
            return view('partials.alquilados', compact('alquilados'))->render();
        }

        return view('equiposAlquilados', compact('alquilados'));
    }

    public function finalizar(Request $request, $id)
    {
        $request->validate([
            'fecha_fin' => 'required|date'
        ]);

        $alquiler = AlquilerEquipo::findOrFail($id);

        $alquiler->update([
            'fecha_fin_alquiler' => $request->fecha_fin,
        ]);

        return response()->json(['success' => 'Finalización de alquiler']);
    }

    public function import(Request $request)
    {
        $file = $request->file('archivo_csv');
        Excel::import(new AlquiladosImport, $file);
        return response()->json(['success' => 'Importación realizada con exíto']);
    }
}
