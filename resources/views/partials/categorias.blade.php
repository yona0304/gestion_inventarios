<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Categoria
            </th>
            <th scope="col" class="px-6 py-3">
                Prefijo
            </th>
            <th scope="col" class="px-6 py-3">
                Acción
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($selectCategoria as $category)
            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $category->nombre_categoria }}
                </th>
                <td class="px-6 py-4">
                    {{ $category->prefijo }}
                </td>
                <td class="px-6 py-4">
                    <button class="bg-red-500 text-white px-3 py-1 rounded-md"
                        onclick="deleteCategoria('{{ $category->id }}')">Desactivar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $selectCategoria->links() !!}
</div>
