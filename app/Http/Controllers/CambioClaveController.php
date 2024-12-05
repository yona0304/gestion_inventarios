<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CambioClaveController extends Controller
{
    public function index(Request $request)
    {
        return view('cambio');
    }

    public function update(Request $request)
    {
        // Valida los campos de la solicitud
        $request->validate([
            'contra_actual' => 'required', // La contraseña actual es obligatoria
            'nueva_contrase' => 'required|min:8|confirmed', // La nueva contraseña es obligatoria, debe tener al menos 8 caracteres y coincidir con la confirmación
        ]);

        // Obtiene el usuario autenticado
        $user = User::find(Auth::id());

        // Verifica si la contraseña actual proporcionada coincide con la contraseña almacenada
        if (!Hash::check($request->contra_actual, $user->password)) {
            // Si no coincide, retorna un mensaje de error en formato JSON
            return response()->json(['error'  => 'La contraseña actual no es correcta.']);
        }

        // Si la contraseña actual es correcta, se procede a actualizar la contraseña con la nueva
        $user->password = Hash::make($request->nueva_contrase); // Hashea la nueva contraseña antes de guardarla


        try {
            // Intenta guardar el nuevo valor en la base de datos
            $user->save();
            // Si todo va bien, retorna un mensaje de éxito en formato JSON
            return response()->json(['success' => 'Contraseña cambiada correctamente.']);
        } catch (\Exception $e) {
            // Si ocurre un error durante la actualización, retorna un mensaje de error en formato JSON
            return response()->json(['error' => 'Error al actualizar la contraseña.']);
        }
    }
}
