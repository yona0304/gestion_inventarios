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
            'color' => 'required|string',
            'llave' => 'required|string',
            'terpel' => 'required|string',
            'placa' => 'required|string',
            'descripcion_vehiculo' => 'required|string',
            'traccion' => 'required|string',
            'modelo' => 'required|string',
            'proveedor' => 'required|string',
            'tipo_proveedor' => 'required|string',
            'valor' => 'required|numeric',
            'fecha_entrega' => 'required|string',
            'fecha_devolucion' => 'nullable|string',
        ]);

        // Verificar si ya existe un vehículo con la misma placa
        $vehiculoExistente = Vehiculo::where('placa', $request->placa)->first();
        if ($vehiculoExistente) {
            // Retornar un mensaje de error si la placa ya está registrada
            return response()->json(['error' => 'La placa ya está registrada.'], 409); // Código de error HTTP 409
        }


        // Registrar el vehículo en la base de datos
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
