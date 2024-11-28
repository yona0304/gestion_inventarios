<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class RegistrarCategoriaController extends Controller
{
    public function index(Request $request)
    {
        $selectCategoria = Categoria::Catego($request->BusCategoria)->paginate(5);

        if ($request->ajax()) {
            return view('partials.categorias', compact('selectCategoria'))->render();
        }

        return view('categoria', compact('selectCategoria'));
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

        // Verificamos si la categoria esta registra en los productos
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
        }

        return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
    }
}
