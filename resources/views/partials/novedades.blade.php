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
                Descripción
            </th>
            <th scope="col" class="px-6 py-3">
                F. Novedad
            </th>
            <th scope="col" class="px-6 py-3">
                T. Novedad
            </th>
            <th scope="col" class="px-6 py-3">
                Estado
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($novedades as $novedad)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{$novedad->producto->codigo_interno . ' - ' . $novedad->producto->categoria->nombre_categoria }}
                </th>
                <td class="px-6 py-4">
                    {{ $novedad->usuario->nombres ?? '' }}
                </td>
                <td class="px-6 py-4">
                    {{ $novedad->descripcion }}
                </td>
                <td class="px-6 py-4">
                    {{ $novedad->fecha_novedad }}
                </td>
                <td class="px-6 py-4">
                    {{ $novedad->tipo_novedad }}
                </td>
                <td class="px-6 py-4">
                    {{ $novedad->estado }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $novedades->links() !!}
</div>
