<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Producto
            </th>
            <th scope="col" class="px-6 py-3">
                Profesional
            </th>
            <th scope="col" class="px-6 py-3">
                F. Asignado
            </th>
            <th scope="col" class="px-6 py-3">
                Descripción
            </th>
            <th scope="col" class="px-6 py-3">
                Sede
            </th>
            <th scope="col" class="px-6 py-3">
                Estado
            </th>
            <th scope="col" class="px-6 py-3">
                Devolución
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($asignaciones as $asignacion)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $asignacion->producto ? $asignacion->producto->codigo_interno . ' - ' . $asignacion->producto->categoria->nombre_categoria : $asignacion->vehiculo->placa . ' - VEHICULO' }}
                </th>
                <td class="px-6 py-4">
                    {{ $asignacion->usuario->nombres }}
                </td>
                <td class="px-6 py-4">
                    {{ $asignacion->fecha_asignacion }}
                </td>
                <td class="px-6 py-4">
                    {{ $asignacion->observaciones }}
                </td>
                <td class="px-6 py-4">
                    {{ $asignacion->ubicacion }}
                </td>
                <td class="px-6 py-4">
                    <button
                        class="asignado-btn {{ $asignacion->estado === 'Disponible' ? 'disponible' : ($asignacion->estado === 'Asignado' ? 'asignado' : ($asignacion->estado === 'Retirado' ? 'retirado' : ($asignacion->estado === 'Devolución' ? 'devolucion' : ''))) }}"
                        data-id="{{ $asignacion->id }}">
                        {{ $asignacion->estado }}
                    </button>
                </td>
                <td class="px-6 py-4">
                    {{ $asignacion->fecha_devolucion }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $asignaciones->links() !!}
</div>
