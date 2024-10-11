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
        /* $request->validate([
            'user' => 'required|int',
        ]); */
        //El sistema busca el documento de user utilizando un request del input "user"
        $usuario = $request->input('user');
        $user = User::where('identificacion', $usuario)->first();

        //si no existe un usuario con esa identificacion no se ejecutara el codigo
        if (!$user) {
            return redirect()->back()->withErrors('Usuario no encontrado.');
        }

        //El sistema busca el sargo del ususario
        $cargoUser = $user->cargo_id;
        //el sistema busca el ID del usuario
        $usuarioId = $user->id;

        //El sistema busca en la tabla de dotaciones aquellas dotaciones que tengan relacionado el cargo del usuario
        $dotaRequerida = Dotaciones::where('id_cargo', $cargoUser);

        //El sistema identifica en las dotaciones si estas coinciden con las que el usuario requiere
        /* $dotaAsignada = AsignacionEquipo::whereIn('producto_id', $dotaRequerida->pluck('id_activo')) */
        $dotaAsignada = AsignacionEquipo::whereHas('producto', function ($query) use ($dotaRequerida) {
            $query->whereIn('categoria_id', $dotaRequerida->pluck('id_activo'));
        })
            ->where('usuario_id', $usuarioId)
            ->get();
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

        $prodIds = $dotaAsignada->pluck('producto_id');
        $prodList = Producto::whereIn('id', $prodIds);
        $prodNoList = $prodList->pluck('categoria_id');
        $dotaFaltantes = Categoria::whereNotIn('id', $prodNoList)->get();

        /* $dotaFaltantes = Dotaciones::where('id_activo',$prodList->pluck('categoria_id'))
        ->get(); */



        /* $dotaFaltantes = AsignacionEquipo::whereHas('producto', function ($query) use ($dotaAsignada) {
            $query->whereNotIn('categoria_id', $dotaAsignada->pluck('id_activo'));
        })
        ->get(); */

        /* Dotaciones::where('id_cargo', $cargoUser )
        ->whereNotIn('id_activo', $dotaAsignada->pluck('producto_id'))
        ->get(); */


        /*$asignado = $dotaRequerida->pluck('id_activo');
        $listo = AsignacionEquipo::where('producto_id', $asignado)->get();*/
        /* $nombre = Producto::where('id', $dotaAsignada->producto_id)->firts();
        $nombre1 = Catgoria::where('id', $nombre->categoria_id); */
        /* $dotaListas = AsignacionEquipo::whereIn('producto_id', $dotaRequerida)
        ->where('usuario_id', $usuarioId) // Filtra por los productos requeridos
        ->get();*/
        /*// Obtén los activos asignados al usuario que coinciden con las dotaciones requeridas
        $asignacionesCoincidentes = Asignaciones::whereIn('id_activo', $dotacionesRequeridas)
            ->where('id_user', $userID)
            ->get();
        // Obtén las dotaciones que faltan al usuario
        $dotacionesFaltantes = Dotacion::where('id_cargo', $cargoUser)
            ->whereNotIn('id_activo', $asignacionesCoincidentes->pluck('id_activo'))
            ->get(); */

        return view('dotaciones', compact('user', 'nombres', 'dotaAsignada', 'dotaFaltantes'));
    }
}
