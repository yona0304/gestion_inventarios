<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrarUsuarioController extends Controller
{
    public function index()
    {
        $cargos = Cargos::all();
        return view('usuario', compact('cargos'));
    }

    public function store(Request $request)
    {

        $estado = "Activo";
        $request->validate([
            'identificacion' => 'required|string|unique:users,identificacion',
            'nombre' => 'required|string',
            'correo' => 'required|string|unique:users,email',
            'ubicacion' => 'required|string',
            'cargo' => 'required|string',
            'ods' => 'required|string',
            'rol' => 'required|string',
        ]);

        // Genera la contraseña solo si el rol es "Super_Admin"
        $password = Hash::make($request->identificacion);

        //registrar producto en la base de datos
        User::create([
            'nombres' => $request->nombre,
            'identificacion' => $request->identificacion,
            'cargo_id' => $request->cargo,
            'ubicacion' => $request->ubicacion,
            'ods' => $request->ods,
            'rol' => $request->rol,
            'estado' => $estado,
            'email' => $request->correo,
            'password' => $password,
        ]);

        // Retorno un mensaje de éxito
        return response()->json(['success' => 'Usuario Registrado']);
    }
}
