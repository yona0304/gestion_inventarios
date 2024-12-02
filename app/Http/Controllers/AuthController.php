<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para mostrar la vista de login
    public function login()
    {
        return view('auth.bienvenido'); // Retorna la vista 'auth.login'
    }

    // Método para manejar la autenticación del usuario
    public function authenticate(Request $request)
    {
        // Valida los datos recibidos desde el formulario de login
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Campo 'email' es obligatorio y debe ser un correo válido
            'password' => ['required'], // Campo 'password' es obligatorio
        ]);

        // Intenta autenticar al usuario utilizando las credenciales proporcionadas
        // Además, verifica que el estado del usuario sea 'Activo'
        if (Auth::attempt(array_merge($credentials, ['estado' => 'Activo']))) {
            // Si la autenticación es exitosa, regenera la sesión del usuario
            $request->session()->regenerate();

            // Obtener el rol del usuario autenticado
            $role = Auth::user()->rol;

            // Redirigir al usuario según su rol
            if ($role === 'Super_Admin') {
                return redirect()->route('inicio');  // Redirige a /inicio si es Super_Admin
            } elseif ($role === 'Personal') {
                return redirect()->route('Dotacion');  // Redirige a /Dotacion si es Personal
            }

            // Redirige al usuario a la ruta/intención previa o a la página de inicio ('/inicio')
            return redirect()->intended('/inicio');
        }

        // Si la autenticación falla, retorna a la página de login con un mensaje de error
        return back()->with('error', 'Las credenciales proporcionadas no coinciden con nuestros registros.');
    }

    // Método para cerrar la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario autenticado

        // Invalida la sesión actual para evitar posibles usos indebidos
        $request->session()->invalidate();

        // Regenera el token CSRF para la seguridad de futuras solicitudes
        $request->session()->regenerateToken();

        // Redirige al usuario a la página principal ('/')
        return redirect('/');
    }
}
