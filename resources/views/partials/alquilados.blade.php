<table class="w-full text-sm text-left rtl:text-right text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">
                Tipo
            </th>
            <th scope="col" class="px-6 py-3">
                Producto
            </th>
            <th scope="col" class="px-6 py-3">
                Valor
            </th>
            <th scope="col" class="px-6 py-3">
                Ubicación
            </th>
            <th scope="col" class="px-6 py-3">
                Profesional
            </th>
            <th scope="col" class="px-6 py-3">
                Fecha Alquiler
            </th>
            <th scope="col" class="px-6 py-3">
                Fin Alquiler
            </th>
            <th scope="col" class="px-6 py-3">
                Acción
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($alquilados as $alquilado)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $alquilado->tipo_producto }}
                </th>
                <td class="px-6 py-4">
                    {{ $alquilado->producto }}
                </td>
                <td class="px-6 py-4">
                    {{ number_format($alquilado->valor_contratado, 0, '', '.') }}
                </td>
                <td class="px-6 py-4">
                    {{ $alquilado->ubicacion }}
                </td>
                <td class="px-6 py-4">
                    {{ $alquilado->usuarios->identificacion }}
                </td>
                <td class="px-6 py-4">
                    {{ $alquilado->fecha_inicio_alquiler }}
                </td>
                <td class="px-6 py-4">
                    {{ $alquilado->fecha_fin_alquiler }}
                </td>
                <td class="px-6 py-4">
                    @if (!$alquilado->fecha_fin_alquiler)
                        <button class="finalizar-btn font-medium text-blue-600 hover:underline"
                            data-id="{{ $alquilado->id }}" data-url="{{ route('alquiler.finalizar', $alquilado->id) }}">
                            Finalizar
                        </button>
                    @else
                        <!-- Si quieres ocultar el botón, deja vacío o comenta el else -->
                        <button class="font-medium text-gray-400 cursor-not-allowed" disabled>
                            Finalizado
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<div class="pagination">
    {!! $alquilados->links() !!}
</div>

<div id="finalizardiv" class="fixed inset-0 hidden z-50 overflow-y-auto">
    <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative w-full max-w-lg rounded-lg shadow bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                    Finalizar alquiler
                </h3>
                <button type="button"
                    class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="finalizardiv">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form method="POST" id="finalizarForm" action="">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium leading-6 text-gray-900">Fecha fin
                            alquiler</label>
                        <div class="mt-2">
                            <input type="date" name="fecha_fin" id="fecha_fin" autocomplete="off" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="w-full flex justify-between mt-4">
                        <button type="submit"
                            class="w-1/3 bg-red-800 text-white py-2 rounded-md shadow-sm hover:bg-red-600">
                            Finalizar alquiler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
