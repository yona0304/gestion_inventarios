<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        return view('vehiculo');
    }

    public function store(Request $request)
    {

        $estado = "Disponible";
        $request->validate([
            'color' => 'nullable|string',
            'llave' => 'nullable|string',
            'terpel' => 'nullable|string',
            'placa' => 'nullable|string',
            'descripcion_vehiculo' => 'nullable|string',
            'traccion' => 'nullable|string',
            'modelo' => 'nullable|string',
            'proveedor' => 'nullable|string',
            'tipo_proveedor' => 'nullable|string',
            'valor' => 'nullable|numeric',
            'fecha_entrega' => 'nullable|string',
            'fecha_devolucion' => 'nullable|string',
        ]);


        //registrar producto en la base de datos
        Vehiculo::create([
            'color' => $request->color,
            'llave' => $request->llave,
            'terpel' => $request->terpel,
            'placa' => $request->placa,
            'descripcion_vehiculo' => $request->descripcion_vehiculo,
            'traccion' => $request->traccion,
            'modelo' => $request->modelo,
            'proveedor_contratante' => $request->proveedor,
            'tipo_proveedor' => $request->tipo_proveedor,
            'valor_contratado' => $request->valor,
            'fecha_entregaProveedor' => $request->fecha_entrega,
            'fecha_devolucionProveedor' => $request->fecha_devolucion,
            'estado' => $estado,
        ]);

        // Retorno un mensaje de éxito
        return response()->json(['success' => 'Vehiculo Registrado']);
    }
}
