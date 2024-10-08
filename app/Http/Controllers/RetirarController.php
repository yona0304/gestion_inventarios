<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RetirarController extends Controller
{
    public function index()
    {
        return view('retirarAsignacion');
    }

    public function show($id_producto, $identificacion)
    {
        $productos = Producto::where('codigo_interno', $id_producto)
            ->orWhere('codigo_equipo_referencia', $id_producto)
            ->first();

        if ($productos) {
            $informacionProducto = Producto::where('id', $productos->id)
                ->firstOrFail(['categoria_id', 'descripcion_equipo', 'estado']);

            // Si el estado no es "Asignado", devolver un error
            if ($informacionProducto->estado !== 'Asignado') {
                return response()->json(['error' => 'El equipo no está asignado.'], 404);
            }

            $usuarios = User::where('identificacion', $identificacion)->first();


            if (!$usuarios) {
                return response()->json(['error' => 'Usuario no encontrado.'], 404);
            }

            $asignaciones = AsignacionEquipo::where('producto_id', $informacionProducto->id)
                ->where('usuario_id', $usuarios->id)
                ->where('estado', 'Asignado')
                ->firstOrFail(['fecha_asignacion']);

            if ($informacionProducto && $asignaciones) {

                $categoriaId = Categoria::where('id', $informacionProducto->categoria_id)->firstOrFail(['nombre_categoria']);


                return response()->json([
                    'descripcion_equipo' => $informacionProducto->descripcion_equipo,
                    'categoria' => $categoriaId->nombre_categoria,
                    'fecha_asignacion' => Carbon::parse($asignaciones->fecha_asignacion)->format('d-m-Y'),
                ]);
            }
        }

        $vehiculo = Vehiculo::where('placa', $id_producto)->first();
        if ($vehiculo) {
            $informacionVehiculo = Vehiculo::where('id', $vehiculo->id)
                ->firstOrFail(['descripcion_vehiculo', 'estado']);

            // Si el estado no es "Asignado", devolver un error
            if ($informacionVehiculo->estado !== 'Asignado') {
                return response()->json(['error' => 'El vehículo no está asignado.'], 404);
            }

            $usuarios = User::where('identificacion', $identificacion)->first();


            if (!$usuarios) {
                return response()->json(['error' => 'Usuario no encontrado.'], 404);
            }

            $asignaciones = AsignacionEquipo::where('vehiculo_id', $informacionVehiculo->id)
                ->where('usuario_id', $usuarios->id)
                ->where('estado', 'Asignado')
                ->firstOrFail(['fecha_asignacion']);

            if ($informacionVehiculo && $asignaciones) {

                return response()->json([
                    'descripcion_equipo' => $informacionVehiculo->descripcion_vehiculo,
                    'fecha_asignacion' => Carbon::parse($asignaciones->fecha_asignacion)->format('d-m-Y'),
                ]);
            }
        }
        return response()->json(['error' => 'Producto o vehículo no encontrado.'], 404);
    }
}
