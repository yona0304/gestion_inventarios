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

            $asignaciones = AsignacionEquipo::where('producto_id', $productos->id)
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

            $asignaciones = AsignacionEquipo::where('vehiculo_id', $vehiculo->id)
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

    public function update(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|string',
            'identificacion' => 'required|numeric',
            'fecha_devolucion' => 'required|date',
            'novedad' => 'nullable|string',
        ]);

        // $modiFecha = Carbon::parse($request->fecha_devolucion)->format('Y-m-d');

        $productos = Producto::where('codigo_interno', $request->id_producto)
            ->orWhere('codigo_equipo_referencia', $request->id_producto)
            ->first();

        if ($productos) {
            $usuarios = User::where('identificacion', $request->identificacion)->first();

            $asignaciones = AsignacionEquipo::where('producto_id', $productos->id)
                ->where('usuario_id', $usuarios->id)
                ->where('estado', 'Asignado')
                ->first();

            if ($asignaciones) {
                $asignaciones->update([
                    'estado' => 'Devolución',
                    'fecha_devolucion' => $request->fecha_devolucion,
                    'observaciones' => $request->novedad
                ]);

                Producto::where('codigo_interno', $request->id_producto)
                    ->orWhere('codigo_equipo_referencia', $request->id_producto)
                    ->update(['estado' => 'Disponible']);

                return response()->json(['success' => 'Equipo devuelto correctamente']);
            }
        }
        $vehiculo = Vehiculo::where('placa', $request->id_producto)->first();

        if ($vehiculo) {
            $usuarios = User::where('identificacion', $request->identificacion)->first();

            $asignaciones = AsignacionEquipo::where('vehiculo_id', $vehiculo->id)
                ->where('usuario_id', $usuarios->id)
                ->where('estado', 'Asignado')
                ->first();

            if ($asignaciones) {
                $asignaciones->update([
                    'estado' => 'Devolución',
                    'fecha_devolucion' => $request->fecha_devolucion,
                    'observaciones' => $request->novedad
                ]);

                Vehiculo::where('id', $vehiculo->id)
                    ->update(['estado' => 'Disponible']);

                return response()->json(['success' => 'Vehículo devuelto correctamente']);
            }
        }
        return response()->json(['success' => false, 'message' => 'No se encontró la asignación'], 404);
        // return response()->json(['error' => 'No se encontró la asignación'], 404);
    }
}
