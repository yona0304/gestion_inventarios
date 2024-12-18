<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\AsignacionEquipo;
use Illuminate\Http\Request;

class RegistrarCategoriaController extends Controller
{
    public function index(Request $request)
    {
        $selectCategoria = Categoria::Catego($request->BusCategoria)->where('estado', null)->paginate(5);

        if ($request->ajax()) {
            return view('partials.categorias', compact('selectCategoria'))->render();
        }

        $selectCategoriaDesactivado = Categoria::where('estado', 'desactivado')->get();

        return view('categoria', compact('selectCategoria', 'selectCategoriaDesactivado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string',
            'prefijo' => 'required|string',
        ]);

        $categorias = strtoupper($request->categoria);
        $prefijos = strtoupper($request->prefijo);

        Categoria::create([
            'nombre_categoria' => $categorias,
            'prefijo' => $prefijos
        ]);

        return response()->json(['success' => 'Categoria Registrado']);
    }

    public function destroy($id)
    {
        // buscamos la categoria por la el id, atraves de un json y js
        $CategoriaSeleccionada = Categoria::where('id', $id)->first();
        //tomando los productos a actualizar
        $productosActualizados = Producto::where('categoria_id', $CategoriaSeleccionada->id)
            ->pluck('id');
        $asignaciones = AsignacionEquipo::whereIn('producto_id', $productosActualizados)
            ->where('estado', 'Asignado')
            ->get();

        /* // Verificamos si la categoria esta registra en los productos
        if ($CategoriaSeleccionada && $CategoriaSeleccionada->productos()->count() > 0) {
            // Si la categoria esta relacionada con productos, devolvera un mensaje de error, debido a que esta tiene una relación
            return response()->json(['success' => false, 'message' => 'Categoría relacionada a productos.'], 400);
        }

        // Si el usuario existe, lo elimina de la base de datos
        if ($CategoriaSeleccionada) {
            $CategoriaSeleccionada->delete();
            // Retorna una respuesta en JSON indicando el éxito de la operación
            return response()->json(['success' => true, 'message' => 'Eliminación de categoría exitosa.']);
            // return response()->json(['success' => 'Eliminación de categoria exitoso']);
        } */
        /* if ($asignaciones) {
            return response()->json(['success' => false, 'message' => 'Hay asignaciones relacionadas a esta categoria.'], 400);
        } */
        if ($asignaciones->isNotEmpty()) {
            // Si hay registros, manda el mensaje de error.
            return response()->json([
                'success' => false,
                'message' => 'Hay asignaciones relacionadas a esta categoría.'
            ], 400);
        }
        if ($CategoriaSeleccionada) {
            Categoria::where('id', $CategoriaSeleccionada->id)
                ->update(['estado' => 'desactivado']);
            // Realizar la actualización
            Producto::whereIn('id', $productosActualizados)
                ->update(['estado' => 'desactivado']);


            return response()->json(['success' => true, 'message' => 'Desactivacion de categoría exitosa.']);
        }



        return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
    }
    public function update($id)
    {
        $CategoriaSeleccionada = Categoria::where('id', $id)->first();

        if ($CategoriaSeleccionada) {
            Categoria::where('id', $CategoriaSeleccionada->id)
                ->update(['estado' => null]);

            return response()->json(['success' => true, 'message' => 'Activacion de categoría exitosa.']);
        }
        return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
    }
}
