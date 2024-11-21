<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ListaProductosController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::with('categoria')
            ->Product(
                $request->BuProducto,
                $request->BuCategoria,
                $request->BuInterno,
                $request->BuEquipo,
                $request->BuUbicacion,
                $request->BuReferencia,
                $request->BuEstado
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.productos', compact('productos'))->render();
        }

        return view('listaProductos', compact('productos'));
    }

    public function datosAsignacion($id)
    {

        $asignacion = AsignacionEquipo::with(['usuario.cargos'])
            ->where('producto_id', $id)
            ->where('estado', 'Asignado')
            ->first();

        return response()->json([
            'usuario' => $asignacion->usuario,
            'cargo' => $asignacion->usuario->cargos->cargo ?? 'Sin cargo',
            'asignacion' => $asignacion,
        ]);
    }
}
