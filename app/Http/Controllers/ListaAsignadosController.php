<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class ListaAsignadosController extends Controller
{
    public function index(Request $request)
    {
        $asignaciones = AsignacionEquipo::with('producto', 'usuario', 'vehiculo')
            ->Asignar(
                $request->BusProducto,
                $request->BusProfesional,
                $request->BusFecha,
                $request->BusUbicacion,
                $request->BusEstado,
                $request->BusDevolucion,
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.asignaciones', compact('asignaciones'))->render();
        }

        return view('listaAsignados', compact('asignaciones'));
    }

    public function datos($id)
    {
        $asignacion = AsignacionEquipo::with(['vehiculo', 'producto', 'usuario.cargos'])->where('id', $id)->first();

        return response()->json([
            'producto' => $asignacion->producto,
            'vehiculo' => $asignacion->vehiculo,
            'usuario' => $asignacion->usuario,
            'cargo' => $asignacion->usuario->cargos->cargo ?? 'Sin cargo',
            'asignacion' => $asignacion,
        ]);
    }
}
