<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\AsignacionEquipo;
use App\Models\Dotaciones;
use App\Models\Cargo;
use App\Models\Producto;
use Illuminate\Http\Request;

class DotacionController extends Controller
{
    //
    public function index()
    {
        return view('dotaciones');
    }

    public function dotacion(Request $request)
    {
        //Validacion del formulario.
        $request->validate([
            'user' => 'required|integer',
        ]);

        //El sistema busca el documento de user utilizando un request del input "user"
        $usuario = $request->input('user');
        $user = User::where('identificacion', $usuario)->first();

        //Si no existe un usuario con esa identificacion no se ejecutara el codigo
        if (!$user) {
            return redirect()->back()->withErrors('Usuario no encontrado.');
        }

        //El sistema busca el cargo del ususario
        $cargoUser = $user->cargo_id;
        //el sistema busca el ID del usuario
        $usuarioId = $user->id;

        //El sistema busca en la tabla de dotaciones aquellas dotaciones que tengan relacionado el cargo del usuario
        $dotaRequerida = Dotaciones::where('id_cargo', $cargoUser);

        //El sistema identifica las asignaciones y verifica que coincidan con las dotaciones requeridas para el cargo
        $dotaAsignada = AsignacionEquipo::whereHas('producto', function ($query) use ($dotaRequerida) {
            $query->whereIn('categoria_id', $dotaRequerida->pluck('id_activo'));
        })
            ->where('usuario_id', $usuarioId)
            ->get();
        //El sistema busca los datos relacionados con el nombre de los praductos para imprimirlos en la vista
        $nombres = Producto::whereIn('id', $dotaAsignada->pluck('producto_id'))
            ->with('categoria') // Cargar la relación
            ->get()
            ->map(function ($producto) {
                return [
                    'producto' => $producto->categoria_id, // Ajusta 'nombre' según tu modelo
                    'categoria' => $producto->categoria->nombre_categoria ?? 'Sin categoría', // Manejo de null
                    'producto1' => $producto->descripcion_equipo,
                ];
            });

        //el sistema busca el id de los productos asignados
        $prodIds = $dotaAsignada->pluck('producto_id');
        //el sistema busca los productos asignados en la tabla de productos
        $prodList = Producto::whereIn('id', $prodIds);
        //el sistma usa los datos obtenidos de la trabla de productos para obtener la catogoria de cada producto
        $prodNoList = $prodList->pluck('categoria_id');
        //el sistema  los datos de categoria que coincidan con la lista de los productos asignados
        $catList = Categoria::whereIn('id', $prodNoList)->pluck('id');
        //el sistema busca el dato de id_activo de la tabla de dotaciones requeridas
        $dotaReq= $dotaRequerida->pluck('id_activo');
        //el sistema compara las dotaciones requeridas(dotaReq) y las asignadas(catList)
        $dotacionesNoCoinciden = $dotaReq->diff($catList);
        //el sistema busca los dotaciones faltante buscando el id de las "dotaNoCoinciden" en la tabla de categoria
        $dotaFaltantes = Categoria::whereIn('id', $dotacionesNoCoinciden->toArray())->get();

        return view('dotaciones', compact('user', 'nombres', 'dotaAsignada', 'dotaFaltantes'));
    }
}
