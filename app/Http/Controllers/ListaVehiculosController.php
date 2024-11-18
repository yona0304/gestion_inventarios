<?php

namespace App\Http\Controllers;

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
}
