<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class AsignarController extends Controller
{
    public function index(Request $request)
    {

        $productos =  Producto::where('estado', 'Disponible')->get(['codigo_interno', 'codigo_equipo_referencia']);

        $asignacion = User::where('estado', 'Activo')->get(['nombres', 'identificacion']);

        //obtenemos los valores por separados de productos, y lo convertimos en un array estandar normal
        $codigosInternos = $productos->pluck('codigo_interno')->toArray();

        $referencias = $productos->pluck('codigo_equipo_referencia')->toArray();

        return view('asignar', compact('asignacion', 'codigosInternos', 'referencias'));
    }

    public function store(Request $request)
    {
        $estado = "Asignado";
        $request->validate([
            'codigo_interno' => 'required|string',
            'profesional' => 'required|string',
            'ubicacion' => 'required|string',
            'fecha_asignacion' => 'required|date',
            'observaciones' => 'required|string',
        ]);

        // $producto = Producto::where('codigo_interno', $request->codigo_interno)->first();
        $producto = Producto::where('codigo_interno', $request->codigo_interno)
            ->orWhere('codigo_equipo_referencia', $request->codigo_interno)
            ->first();
        $usuario = User::where('identificacion', $request->profesional)->first();

        if (!$producto) {
            return response()->json(['success' => false, 'message' => 'El producto no existe.'], 404);
        }

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'La identificación del profesional no existe.'], 404);
        }

        $productoId = $producto->id;
        $usuarioI = $usuario->id;

        //registrar producto en la base de datos
        AsignacionEquipo::create([
            'producto_id' => $productoId,
            'usuario_id' => $usuarioI,
            'fecha_asignacion' => $request->fecha_asignacion,
            'observaciones' => $request->observaciones,
            'estado' => $estado,
            'ubicacion' => $request->ubicacion
        ]);

        // Actualizar el estado del producto a 'Asignado'
        $producto->update(['estado' => $estado]);

        // Retorno un mensaje de éxito
        return response()->json(['success' => true, 'message' => 'Equipo asignado correctamente.']);
    }
}
