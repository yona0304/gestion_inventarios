<?php

namespace App\Http\Controllers;

use App\Models\HistorialComputo;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HistorialComputoController extends Controller
{
    public function index(Request $request)
    {

        $productos =  Producto::where('categoria_id', '4')
            ->get(['codigo_interno']);

        $codigosInternos = $productos->pluck('codigo_interno')->toArray();

        $historiales = HistorialComputo::with('producto')
            ->Equipo(
                $request->input('Equipo'),
                $request->input('FechaHistorial')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('partials.historial', compact('historiales'))->render();
        }

        return view('historialComputo', compact('historiales', 'codigosInternos'));
    }

    public function store(Request $request)
    {
        // Validación de los campos
        $validated = $request->validate([
            'producto_id'       => 'required|string|exists:productos,codigo_interno',
            'marca'             => 'nullable|string|max:255',
            'modelo'            => 'nullable|string|max:255',
            'hostname'          => 'nullable|string|max:255',
            't_equipo'          => 'nullable|string|max:255',
            'serial'            => 'required|string|max:255',
            'procesador'        => 'nullable|string|max:255',
            'disco'             => 'nullable|string|max:255',
            'ram'               => 'nullable|string|max:255',
            's_instalado'       => 'nullable|string|max:255',
            'licencias'         => 'nullable|string|max:255',
            's_operativo'       => 'nullable|string|max:255',
            'licencia'          => 'nullable|string|max:255',
            'antivirus'         => 'nullable|string|max:255',
            'version_licencia'  => 'nullable|string|max:255',
            'observaciones'     => 'nullable|string|max:1000',
            'fecha_registro'    => 'required|date',
            'estado'            => 'required|string|max:150',
        ]);

        //buscamos el producto por el codigo interno
        $idProducto = Producto::where('codigo_interno', $request->producto_id)->first();

        //verificamos si el producto se encuentra en la base de datos
        if (!$idProducto) {
            return response()->json(['error' => 'Producto no encontrado con el código interno proporcionado.'], 404);
        }

        // // Verificar si el producto está asignado
        // if ($idProducto->estado === 'Asignado') {
        //     return response()->json(['error' => 'El producto está asignado. Por favor, retire la asignación antes de registrar el historial.'], 400);
        // }

        $estado = $request->estado;

        //establecer el estado basado en la selección que realizamos en el formulario
        switch ($estado) {
            case 'Mantenimiento':
                $estado = 'Mantenimiento';
                break;
            case 'Activado':
                $estado = 'Activo';
                break;
                // case 'Retiro':
                //     $estado = 'Retirado';
                //     break;
                // default:
                //     $estado = 'Pendiente'; // Por defecto, o cuando no coincide con las opciones
                //     break;
        }

        //creamos el registro en el historial
        HistorialComputo::create([
            'producto_id'       => $idProducto->id,
            'marca'             => $validated['marca'] ?? null,
            'modelo'            => $validated['modelo'] ?? null,
            'hostname'          => $validated['hostname'] ?? null,
            't_equipo'          => $validated['t_equipo'] ?? null,
            'serial'            => $validated['serial'],
            'procesador'        => $validated['procesador'] ?? null,
            'disco'             => $validated['disco'] ?? null,
            'ram'               => $validated['ram'] ?? null,
            's_instalado'       => $validated['s_instalado'] ?? null,
            'licencias'         => $validated['licencias'] ?? null,
            's_operativo'       => $validated['s_operativo'] ?? null,
            'licencia'          => $validated['licencia'] ?? null,
            'antivirus'         => $validated['antivirus'] ?? null,
            'version_licencia'  => $validated['version_licencia'] ?? null,
            'observaciones'     => $validated['observaciones'] ?? null,
            'fecha_registro'    => $validated['fecha_registro'],
            'estado'    => $estado ?? null,
        ]);

        // Producto::where('id', $idProducto->id)
        //     ->update(['estado' => $estado]);

        return response()->json(['success' => 'Hisorial registrado.']);
    }
}
