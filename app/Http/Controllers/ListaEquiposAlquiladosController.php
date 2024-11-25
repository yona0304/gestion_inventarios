<?php

namespace App\Http\Controllers;

use App\Models\AlquilerEquipo;
use App\Imports\AlquiladosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ListaEquiposAlquiladosController extends Controller
{
    public function index(Request $request)
    {
        $alquilados = AlquilerEquipo::with('usuarios')
            ->Alquile(
                $request->BusAlquiler,
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
