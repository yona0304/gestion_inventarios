<?php

namespace App\Http\Controllers;

use App\Models\AsignacionEquipo;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

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
            ->whereNot('estado', 'desactivado')
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.productos', compact('productos'))->render();
        }
        $desProd = Producto::where('estado', 'desactivado')->get();

        return view('listaProductos', compact('productos', 'desProd'));
    }

    public function datosAsignacion($id)
    {

        $asignacion = AsignacionEquipo::with(['usuario.cargos'])
            ->where('producto_id', $id)
            ->where('estado', 'Asignado')
            ->first();

        return response()->json([
            'usuarios' => $asignacion->usuario,
            'cargo' => $asignacion->usuario->cargos->cargo ?? 'Sin cargo',
            'asignacion' => $asignacion,
        ]);
    }

    // Edita un reporte existente
    public function edit($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_interno' => 'required|string',
            'descripcion_equipo' => 'required|string|max:255',
            'ubicacion' => 'required|string',
            'codigo_equipo_referencia' => 'required|string|max:155',
        ]);

        $producto = Producto::findOrFail($id);

        //actualizar datos producto
        $producto->update([
            'codigo_interno' => $request->codigo_interno,
            'descripcion_equipo' => $request->descripcion_equipo,
            'ubicacion' => $request->ubicacion,
            'codigo_equipo_referencia' => $request->codigo_equipo_referencia,
        ]);

        return response()->json(['success' => 'Actualizacion de datos registrada exitosamente']);
    }
    public function actual($id)
    {
        $productoAct = Producto::where('id', $id)->first();

        if ($productoAct) {

            Producto::where('id', $productoAct->id)->first();
            $categoria = Categoria::where('id', $productoAct->categoria_id)->first();
            if ($categoria->estado == 'desactivado') {
                return response()->json(['success' => false, 'message' => 'La categoria a la que pertenece este producto esta desactivada.'], 404);
            }

            Producto::where('id', $productoAct->id)
                ->update(['estado' => 'Disponible']);

            return response()->json(['success' => true, 'message' => 'Activacion de producto exitoso.']);
        }
        return response()->json(['success' => false, 'message' => 'Producto no encontrado.'], 404);
    }
}
