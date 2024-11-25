<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Novedad;
use App\Models\Producto;
use App\Models\AsignacionEquipo;
use App\Models\User;


class NovedadController extends Controller
{
    public function index()
    {
        return view('novedades');
    }
    public function store(Request $request)
    {

        $producto = $request->input('producto');

        $request->validate([
            'producto' => 'required|string',
            'fecha' => 'required|date',
            'tipo_novedad' => 'required|string',
            'descripcion' => 'required|string'
        ]);

        $estado = $request->tipo_novedad;

        $prod = Producto::where('codigo_interno', $producto)
            ->first();
        if ($prod==null){
            return response()->json(['error'=>'No se encontro ningun producto con ese codigo']);
        };

        $asig = AsignacionEquipo::where('producto_id', $prod->id)
        ->where('estado', 'Asignado')
        ->first();
        if ($asig !== null) {
            $test = $asig->producto_id;
        } else {
            // Aquí puedes manejar el caso cuando $asig es null
            $test = null; // O alguna otra lógica
        }
        //$test = $asig->producto_id;

        if ($test !== null){
          $user = User::where('id', $asig)
           ->value('id');

           Novedad::create([
            'producto_id' => $prod->id,
            'usuario_id' => $user,
            'descripcion' => $request->descripcion,
            'fecha_novedad' => $request->fecha,
            'tipo_novedad' => $request->tipo_novedad,
            'estado' =>$estado,
           ]);
           if ($estado=='Mantenimiento'){
            $productoAct = Producto::where('id', $prod->id)
                ->update([
                    'estado' => 'Mantenimiento',
                ]);
           }
           else if($estado=='Activo'){
            $productoAct = Producto::where('id', $prod->id)
            ->update([
                'estado' => 'Asignado',
            ]);
           };

           return response()->json(['success' => 'Mensaje enviado correctamente']);
        }
        else {
            Novedad::create([
            'producto_id' => $prod->id,
            'usuario_id' => null,
            'descripcion' => $request->descripcion,
            'fecha_novedad' => $request->fecha,
            'tipo_novedad' => $request->tipo_novedad,
            'estado' => $request->tipo_novedad,
           ]);
           if ($estado=='Mantenimiento'){
            $productoAct = Producto::where('id', $prod->id)
                ->update([
                    'estado' => 'Mantenimiento',
                ]);
           }
           else if($estado=='Activo'){
            $productoAct = Producto::where('id', $prod->id)
            ->update([
                'estado' => 'Disponible',
            ]);
           };
           return response()->json(['exito' => 'Esta producto no cuenta con un usuario asignado']);
        }
        }
}
