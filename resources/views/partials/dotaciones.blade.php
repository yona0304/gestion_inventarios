<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                Id
            </th>
            <th scope="col" class="px-6 py-3">
                Cargo
            </th>
            <th scope="col" class="px-6 py-3">
                Dotacion
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dotacion as $dotaciones)
            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $dotaciones->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $dotaciones->cargos->cargo }}
                </td>
                <td class="px-6 py-4">
                    {{ $dotaciones->categoria->nombre_categoria }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $dotacion->links() !!}
</div>
