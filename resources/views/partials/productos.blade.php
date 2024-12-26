<table id="filter-table" class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Categoria
            </th>
            <th scope="col" class="px-6 py-3">
                Codigo Interno
            </th>
            <th scope="col" class="px-6 py-3">
                Producto
            </th>
            <th scope="col" class="px-6 py-3">
                Ubicación
            </th>
            <th scope="col" class="px-6 py-3">
                Codigo / Referencia
            </th>
            <th scope="col" class="px-6 py-3">
                Estado
            </th>
            @if (Auth::check() && Auth::user()->rol === 'Super_Admin')
                <th scope="col" class="px-6 py-3">
                    Acción
                </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $producto->categoria->nombre_categoria ?? 'Desconocido' }}
                </th>
                <td class="px-6 py-4">
                    {{ $producto->codigo_interno }}
                </td>
                <td class="px-6 py-4">
                    {{ $producto->descripcion_equipo }}
                </td>
                <td class="px-6 py-4">
                    {{ $producto->ubicacion }}
                </td>
                <td class="px-6 py-4">
                    {{ $producto->codigo_equipo_referencia }}
                </td>
                <td class="px-6 py-4">
                    @if ($producto->estado == 'Asignado')
                        <button
                            class="asignado-producto-btn {{ $producto->estado === 'Disponible' ? 'disponible' : ($producto->estado === 'Asignado' ? 'asignado' : ($producto->estado === 'Retirado' ? 'retirado' : ($producto->estado === 'Devolución' ? 'devolucion' : ''))) }}"
                            data-id="{{ $producto->id }}">
                            {{ $producto->estado }}
                        </button>
                    @else
                        <span
                            class="{{ $producto->estado === 'Disponible' ? 'disponible' : ($producto->estado === 'Retirado' ? 'retirado' : ($producto->estado === 'Devolución' ? 'devolucion' : '')) }}">{{ $producto->estado }}</span>
                    @endif
                </td>
                @if (Auth::check() && Auth::user()->rol === 'Super_Admin')
                    <td class="px-6 py-4">
                        <button class="actualizar-btn bg-blue-500 text-white px-2 py-1 rounded-md"
                            data-producto="{{ $producto->id }}"
                            data-url3="{{ route('lista.actualizar', $producto->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $productos->links() !!}
</div>

<div id="editarProductos" class="fixed inset-0 hidden z-50 overflow-y-auto">
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative w-full max-w-lg rounded-lg shadow bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                    Editar campos
                </h3>
                <button type="button"
                    class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-product="editarProductos">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form method="POST" id="actualizarProductoEdita" action="">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1">
                        <div>
                            <label for="codigo_interno" class="block text-sm font-medium leading-6 text-gray-900">Codigo
                                Interno</label>
                            <div class="mt-2">
                                <input type="text" name="codigo_interno" id="codigo_interno" autocomplete="off"
                                    class="block bg-gray-50 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="descripcion_equipo"
                                class="block text-sm font-medium leading-6 text-gray-900">Descripción
                                producto</label>
                            <div class="mt-2">
                                <textarea rows="4" id="descripcion_equipo" name="descripcion_equipo"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                                    placeholder="Leave a comment..."></textarea>
                            </div>
                        </div>
                        <div>
                            <label for="ubicacion"
                                class="block text-sm font-medium leading-6 text-gray-900">Ubicación</label>
                            <div class="mt-2">
                                <select id="ubicacion" name="ubicacion"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-blue-500 block w-full p-2.5">
                                    <option value="">Seleccionar</option>
                                    <option value="Barrancabermeja">Barrancabermeja</option>
                                    <option value="Bogota">Bogota</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="referencia" class="block text-sm font-medium leading-6 text-gray-900">Codigo /
                                Referencia</label>
                            <div class="mt-2">
                                <input type="text" name="codigo_equipo_referencia" id="referencia" autocomplete="off"
                                    class="block bg-gray-50 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <br>
                        <div>
                            <button type="submit"
                                class="w-1/3 bg-blue-900 text-white py-2 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    let ProductoId = null;

    $(document).on('click', '.editar-btn', function() {

        const ProductoId = $(this).data('producto');

        // Construir la URL de edición
        const url = `/lista-productos/${ProductoId}`;

        // Cargar los datos del producto
        $.get(url, function(data) {
            $('#descripcion_equipo').val(data.descripcion_equipo);
            $('#ubicacion').val(data.ubicacion);
            $('#referencia').val(data.codigo_equipo_referencia);

            $('#editarProductos').removeClass('hidden');
            // Mostrar el modal
        }).fail(function() {
            Swal.fire('Error', 'Error al cargar los datos. Por favor, inténtalo de nuevo.', 'error');
        });
    });

    $(document).on('click', '[data-modal-product]', function() {
        $('#editarProductos').addClass('hidden');
    })


</script> --}}
