<div class="relative overflow-x-auto shadow-md sm:rounded-lg" >
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" style="width: 2500px">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Marca
                </th>
                <th scope="col" class="px-6 py-3">
                    Modelo
                </th>
                <th scope="col" class="px-6 py-3">
                    Hostname
                </th>
                <th scope="col" class="px-6 py-3">
                    T. Equipo
                </th>
                <th scope="col" class="px-6 py-3">
                    Serial
                </th>
                <th scope="col" class="px-6 py-3">
                    Procesador
                </th>
                <th scope="col" class="px-6 py-3">
                    Disco
                </th>
                <th scope="col" class="px-6 py-3">
                    RAM
                </th>
                <th scope="col" class="px-6 py-3">
                    S. Instalado
                </th>
                <th scope="col" class="px-6 py-3">
                    Licencias
                </th>
                <th scope="col" class="px-6 py-3">
                    S. Operativo
                </th>
                <th scope="col" class="px-6 py-3">
                    Licencia
                </th>
                <th scope="col" class="px-6 py-3">
                    Antivirus
                </th>
                <th scope="col" class="px-6 py-3">
                    V & Licencia
                </th>
                <th colspan="2" scope="col" class="px-6 py-3">
                    Observaciones
                </th>

                <th scope="col" class="px-6 py-3">
                    F. Registro
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiales as $historial)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $historial->producto->codigo_interno }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $historial->marca }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->modelo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->hostname }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->t_equipo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->serial }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->procesador }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->disco }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->ram }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->s_instalado }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->licencias }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->s_operativo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->licencia }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->antivirus }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->version_licencia }}
                    </td>
                    <td colspan="2" class="px-6 py-4">
                        {{ $historial->observaciones }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->fecha_registro }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $historial->estado }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="pagination">
        {!! $historiales->links() !!}
    </div>
</div>
