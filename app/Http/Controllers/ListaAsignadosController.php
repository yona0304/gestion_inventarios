<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
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
}
