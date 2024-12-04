<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Novedad;
use App\Models\Producto;
use App\Models\Vehiculo;
use App\Models\AsignacionEquipo;
use App\Models\User;


class NovedadController extends Controller
{
    public function index()
    {
        //PRODUCTOS SELECCIONADOS
        $productos =  Producto::get(['codigo_interno', 'codigo_equipo_referencia']);
        //VEHICULOS SELECCIONADOS
        $vehiculos = Vehiculo::get('placa', 'descripcion_vehiculo');
        //CODIGOS INTERNOS SELECCIONADOS
        $referencias = $productos->pluck('codigo_equipo_referencia')->toArray();
        //CODIGOS INTERNOS DE LOS PRODUCTOS
        $codigosInternos = $productos->pluck('codigo_interno')->toArray();

        return view('novedades', compact('codigosInternos', 'referencias', 'vehiculos'));
    }
    public function store(Request $request)
    {
        //Toma el dato de producto ingresado en el formulario
        $producto = $request->input('producto');
        //Toma el dato de tipo de novedad ingresado en el formulario
        $vale = $request->input('tipo_novedad');
        //Busca el producto de codigo interno
        $prod = Producto::where('codigo_interno', $producto)
            ->first();
        //verifica que el producto exista.
        if ($prod == null) {
            return response()->json(['error' => 'No se encontro ningun producto con ese codigo']);
        };


        //inicia el caso de traslado
        if ($vale == 'Traslado') {
            $request->validate([
                'producto' => 'required|string',
                'fecha' => 'required|date',
                'tipo_novedad' => 'required|string',
                'descripcion' => 'required|string',
                'ubicacion_new' => 'required|string'
            ]);

            $ubicacion = $request->input('ubicacion_new');
            $prod = Producto::where('codigo_interno', $producto)->pluck('ubicacion')->first();;
            $p = Producto::where('codigo_interno', $producto)->first();
            //$ubi = $prod->ubicacion;
            $estate = 'Trasladado desde ' . $prod . ' hacia ' . $ubicacion;

            if ($prod === $ubicacion) {
                return response()->json(['error' => 'No se pueden mover a la misma ciudad.']);
            }

            $asig = AsignacionEquipo::where('producto_id', $p->id)
                ->where('estado', 'Asignado')
                ->first();
            //En caso de que exista una asignacion tome los datos.
            if ($asig !== null) {
                $test = $asig->usuario_id;
            } else {
                // ingresa el dato null para evitar errores
                $test = null; // O alguna otra lógica
            }
            if ($test !== null) {


                Novedad::create([
                    'producto_id' => $p->id,
                    'usuario_id' => $test,
                    'descripcion' => $request->descripcion,
                    'fecha_novedad' => $request->fecha,
                    'tipo_novedad' => $request->tipo_novedad,
                    'estado' => $estate,
                ]);
                $productoAct = Producto::where('id', $p->id)
                    ->update([
                        'ubicacion' => $ubicacion,
                    ]);

                return response()->json(['success' => 'Novedad registrada correctamente. Cambio']);
            }

            Novedad::create([
                'producto_id' => $p->id,
                'usuario_id' => null,
                'descripcion' => $request->descripcion,
                'fecha_novedad' => $request->fecha,
                'tipo_novedad' => $request->tipo_novedad,
                'estado' => $estate,
            ]);

            $productoAct = Producto::where('id', $p->id)
                ->update([
                    'ubicacion' => $ubicacion,
                ]);

            return response()->json(['success' => 'Novedad registrada correctamente. prueba']);
        };
        //Final del traslado

        $request->validate([
            'producto' => 'required|string',
            'fecha' => 'required|date',
            'tipo_novedad' => 'required|string',
            'descripcion' => 'required|string'
        ]);

        $estado = $request->tipo_novedad;

        $asig = AsignacionEquipo::where('producto_id', $prod->id)
            ->where('estado', 'Asignado')
            ->first();
        //En caso de que exista una asignacion tome los datos.
        if ($asig !== null) {
            $test = $asig->usuario_id;
        } else {
            // ingresa el dato null para evitar errores
            $test = null; // O alguna otra lógica
        }
        //inicia la logica en caso de que exista una asignacion al producto
        if ($test !== null) {


            Novedad::create([
                'producto_id' => $prod->id,
                'usuario_id' => $test,
                'descripcion' => $request->descripcion,
                'fecha_novedad' => $request->fecha,
                'tipo_novedad' => $request->tipo_novedad,
                'estado' => $estado,
            ]);

            if ($estado == 'Mantenimiento') {
                $productoAct = Producto::where('id', $prod->id)
                    ->update([
                        'estado' => 'Mantenimiento',
                    ]);
            } else if ($estado == 'Activo') {
                $productoAct = Producto::where('id', $prod->id)
                    ->update([
                        'estado' => 'Asignado',
                    ]);
            };

            return response()->json(['success' => 'Novedad registrada correctamente']);
        } else {
            Novedad::create([
                'producto_id' => $prod->id,
                'usuario_id' => null,
                'descripcion' => $request->descripcion,
                'fecha_novedad' => $request->fecha,
                'tipo_novedad' => $request->tipo_novedad,
                'estado' => $request->tipo_novedad,
            ]);
            if ($estado == 'Mantenimiento') {
                $productoAct = Producto::where('id', $prod->id)
                    ->update([
                        'estado' => 'Mantenimiento',
                    ]);
            } else if ($estado == 'Activo') {
                $productoAct = Producto::where('id', $prod->id)
                    ->update([
                        'estado' => 'Disponible',
                    ]);
            };
            return response()->json(['exito' => 'Esta producto no cuenta con un usuario asignado']);
        }
    }
}
