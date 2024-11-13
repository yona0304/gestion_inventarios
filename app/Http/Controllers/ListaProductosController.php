<?php

namespace App\Http\Controllers;

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
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.productos', compact('productos'))->render();
        }

        return view('listaProductos', compact('productos'));
    }
}
