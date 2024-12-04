<?php

namespace App\Http\Controllers;

use App\Models\Novedad;
use Illuminate\Http\Request;

class ListaNovedadesController extends Controller
{
    public function index(Request $request)
    {
        $novedades = Novedad::with('producto', 'usuario')
            ->Nov(
                $request->BusNoveProducto,
                $request->BusNoveProfesional,
                $request->BusNoveFecha,
                $request->BusNoveTipo,
                $request->BusNoveEstado,
            )
            ->orderBy('fecha_novedad', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.novedades', compact('novedades'))->render();
        }

        return view('listaNovedades', compact('novedades'));
    }
}
