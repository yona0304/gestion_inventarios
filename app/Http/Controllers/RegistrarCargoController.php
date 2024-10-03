<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use Illuminate\Http\Request;

class RegistrarCargoController extends Controller
{
    public function index()
    {
        return view('cargos');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cargo' => 'required|string'
        ]);

        Cargos::create([
            'cargo' => $request->cargo
        ]);

        return response()->json(['success' => 'Cargo Registrado']);
    }
}
