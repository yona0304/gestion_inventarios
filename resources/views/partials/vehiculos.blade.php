<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Placa
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Llave
                </th>
                <th scope="col" class="px-6 py-3">
                    Terpel
                </th>
                <th scope="col" class="px-6 py-3">
                    Vehiculo
                </th>
                <th scope="col" class="px-6 py-3">
                    Tracción
                </th>
                <th scope="col" class="px-6 py-3">
                    Modelo
                </th>
                <th scope="col" class="px-6 py-3">
                    Proveedor Contratante
                </th>
                <th scope="col" class="px-6 py-3">
                    Tipo Proveedor
                </th>
                <th scope="col" class="px-6 py-3">
                    Valor Contratado
                </th>
                <th scope="col" class="px-6 py-3">
                    F.E Proveedor
                </th>
                <th scope="col" class="px-6 py-3">
                    F.D Proveedor
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $vehiculo->placa }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $vehiculo->color }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->llave }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->terpel }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->descripcion_vehiculo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->traccion }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->modelo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->proveedor_contratante }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->tipo_proveedor }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->valor_contratado }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->fecha_entregaProveedor }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $vehiculo->fecha_devolucionProveedor }}
                    </td>
                    {{-- <td
                        class="px-6 py-4 {{ $vehiculo->estado === 'Disponible' ? 'disponible' : ($vehiculo->estado === 'Asignado' ? 'asignado' : ($vehiculo->estado === 'Retirado' ? 'retirado' : ($vehiculo->estado === 'Mantenimiento' ? 'mantenimiento' : ''))) }}">
                        {{ $vehiculo->estado }}
                    </td> --}}
                    <td class="px-6 py-4">
                    @if ($vehiculo->estado == 'Asignado')
                        <button
                            class="asignado-vehiculo-btn {{ $vehiculo->estado === 'Disponible' ? 'disponible' : ($vehiculo->estado === 'Asignado' ? 'asignado' : ($vehiculo->estado === 'Retirado' ? 'retirado' : ($vehiculo->estado === 'Devolución' ? 'devolucion' : ''))) }}"
                            data-id="{{ $vehiculo->id }}">
                            {{ $vehiculo->estado }}
                        </button>
                    @else
                        <span
                            class="{{ $vehiculo->estado === 'Disponible' ? 'disponible' : ($vehiculo->estado === 'Retirado' ? 'retirado' : ($vehiculo->estado === 'Devolución' ? 'devolucion' : '')) }}">{{ $vehiculo->estado }}</span>
                    @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<div class="pagination">
    {!! $vehiculos->links() !!}
</div>
