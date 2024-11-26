<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Producto;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Dotaciones;
use Illuminate\Http\Request;

class AsignarController extends Controller
{
    public function index(Request $request)
    {

        $productos =  Producto::where('estado', 'Disponible')->get(['codigo_interno', 'codigo_equipo_referencia']);

        $asignacion = User::where('estado', 'Activo')->get(['nombres', 'identificacion']);

        $vehiculos = Vehiculo::where('estado', 'Disponible')->get('placa', 'descripcion_vehiculo');

        //obtenemos los valores por separados de productos, y lo convertimos en un array estandar normal
        $codigosInternos = $productos->pluck('codigo_interno')->toArray();

        $referencias = $productos->pluck('codigo_equipo_referencia')->toArray();

        return view('asignar', compact('asignacion', 'codigosInternos', 'referencias', 'vehiculos'));
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

        $vehiculo = Vehiculo::where('placa', $request->codigo_interno)->first();

        $usuario = User::where('identificacion', $request->profesional)->first();

        // if (!$producto) {
        //     return response()->json(['success' => false, 'message' => 'El vehiculo no existe o se encuentra desactivado.'], 404);
        // }

        if (!$producto && !$vehiculo) {
            return response()->json(['success' => false, 'message' => 'El producto o vehiculo no existe.'], 404);
        }

        if (!$usuario) {
            return response()->json(['success' => false, 'message' => 'La identificación del profesional no existe.'], 404);
        }

        if ($producto) {
            //registrar producto en la base de datos
            AsignacionEquipo::create([
                'producto_id' => $producto->id,
                'usuario_id' => $usuario->id,
                'fecha_asignacion' => $request->fecha_asignacion,
                'observaciones' => $request->observaciones,
                'estado' => $estado,
                'ubicacion' => $request->ubicacion
            ]);

            // Actualizar el estado del producto a 'Asignado'
            $producto->update(['estado' => $estado]);

            $usuario = User::where('identificacion', $request->profesional)->first();

            $userCharge = $usuario->cargo_id;

            $dotaReq = Dotaciones::where('id_cargo', $userCharge)
            ->get();

            $asigProd = AsignacionEquipo::where('usuario_id', $usuario->id)
            ->get();

            $idProductos = $asigProd->pluck('producto_id');

            $productos = Producto::whereIn('id', $idProductos)
            ->get();
            // Obtener las IDs de productos requeridos en las dotaciones
            $idProductosRequeridos = $dotaReq->pluck('id_activo');
            // Obtener las IDs de productos asignados
            $idProductosAsignados = $productos->pluck('categoria_id');
            // Comparar si los productos asignados cumplen con los requeridos
            $requerimientosCumplidos = $idProductosRequeridos->diff($idProductosAsignados)->isEmpty();

            if ($requerimientosCumplidos) {
                // Todos los requerimientos están asignados
                User::where('id',  $usuario->id )->update([
                    'dotacion' => '1',
                ]);
                return response()->json(['success' => 'Equipo asignado correctamente. El usuario cuenta con la dotacion completa']);
            }
            User::where('id',  $usuario->id )->update([
                'dotacion' => '0',
            ]);
            // Retorno un mensaje de éxito
                return response()->json(['success' => 'Equipo asignado correctamente.']);
            } else if ($vehiculo) {
                AsignacionEquipo::create([
                    'vehiculo_id' => $vehiculo->id,
                    'usuario_id' => $usuario->id,
                    'fecha_asignacion' => $request->fecha_asignacion,
                    'observaciones' => $request->observaciones,
                    'estado' => $estado,
                    'ubicacion' => $request->ubicacion
                ]);

                // Actualizar el estado del producto a 'Asignado'
                $vehiculo->update(['estado' => $estado]);

                // Retorno un mensaje de éxito
                return response()->json(['success' => 'Vehiculo asignado correctamente.']);
            } else {
                return response()->json(['success' => false, 'message' => 'El producto o vehículo no existe.'], 404);
            }
            // En caso de que no se cumpla ninguna de las condiciones
            return response()->json(['success' => false, 'message' => 'El producto o vehículo no existe.'], 404);
    }
}
