<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class RegistrarProducto extends Controller
{
    public function index()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías para el formulario

        return view('registrarProducto', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Estado inicial del producto
        $estado = "Disponible";

        // Validación de los campos de entrada
        $request->validate([
            'categoria' => 'required|string', // ID de la categoría
            'descripcion' => 'required|string', // Descripción del equipo
            'codigo_referencia' => 'nullable|string', // Código de referencia (opcional)
            'ubicacion' => 'required|string',
            'observacion' => 'nullable|string', // Observaciones (opcional)
        ]);

        // Preparar los datos para crear el producto
        $data = [
            'categoria_id' => $request->categoria, // ID de la categoría
            'descripcion_equipo' => $request->descripcion, // Descripción del equipo
            'codigo_equipo_referencia' => $request->codigo_referencia, // Código de referencia
            'ubicacion' => $request->ubicacion,
            'estado' => $estado, // Estado por defecto del producto
        ];

        // Si el campo observación tiene valor, lo añadimos
        if ($request->filled('observacion')) {
            $data['observaciones'] = $request->observacion;
        }

        // Crear el producto. El código interno se genera automáticamente en el modelo.
        Producto::create($data);

        // Retornar una respuesta JSON para indicar éxito
        return response()->json(['success' => 'Producto registrado con éxito']);
    }

    public function obtenerCodigoInterno($categoriaId)
    {
        // Obtener la categoría
        $categoria = Categoria::find($categoriaId);

        if ($categoria) {
            // Contar cuántos productos hay ya con este prefijo
            $prefijo = $categoria->prefijo; // Asegúrate de que esto esté en la tabla
            $contador = Producto::where('codigo_interno', 'like', "$prefijo-%")->count() + 1;

            // Crear el código interno
            $codigoInterno = sprintf('%s-%03d', $prefijo, $contador);

            return response()->json(['codigo_interno' => $codigoInterno]);
        }

        return response()->json(['codigo_interno' => null]);
    }

}
