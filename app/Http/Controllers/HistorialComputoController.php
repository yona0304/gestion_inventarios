<?php

namespace App\Http\Controllers;

use App\Models\HistorialComputo;
use Illuminate\Http\Request;

class HistorialComputoController extends Controller
{
    public function index(Request $request)
    {

        $historiales = HistorialComputo::paginate(15);

        if ($request->ajax()) {
            return view('partials.historial', compact('historiales'))->render();
        }

        return view('historialComputo', compact('historiales'));
    }
}
