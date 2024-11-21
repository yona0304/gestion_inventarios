<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class ListaVehiculosController extends Controller
{
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::Vehicu($request->vehiculo)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        if ($request->ajax()) {
            return view('partials.vehiculos', compact('vehiculos'))->render();
        }

        return view('listaVehiculos', compact('vehiculos'));
    }

    public function datosVehiculo($id)
    {

        $vehiculo = AsignacionEquipo::with(['usuario.cargos'])
            ->where('vehiculo_id', $id)
            ->where('estado', 'Asignado')
            ->first();

        return response()->json([
            'usuario' => $vehiculo->usuario,
            'cargo' => $vehiculo->usuario->cargos->cargo ?? 'Sin cargo',
            'asignacion' => $vehiculo,
        ]);
    }
}
