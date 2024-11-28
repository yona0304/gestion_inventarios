@extends('layouts.layout')

@section('title', 'Historial Computo - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4 bg-white">
                    <label for="Equipo" class="sr-only">Search</label>
                    <div class="flex items-center justify-between ">
                        <div class="flex flex-wrap gap-2 sm:gap-4 items-center">

                            <div class="relative mt-1 w-full sm:w-auto">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="Equipo"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50"
                                    placeholder="Buscar producto">
                            </div>
                            <div class="mt-1 w-full sm:w-auto">
                                <input type="date" id="FechaHistorial"
                                    class="block pt-2 ps-10 text-sm text-gray-400 border border-gray-300 rounded-lg bg-gray-50"
                                    oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                            </div>

                        </div>

                        {{-- boton en el lado derecho, para modal de historial comuto --}}
                        <div class="mt-1">
                            <button id="mostrarModal"
                                class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                type="button">
                                Ingresar Historial
                            </button>
                        </div>
                    </div>
                </div>
                <div id="HistorialComputador">
                    @include('partials.historial')
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de registrar historial de computo --}}
    <div id="modalRegistar" class="fixed inset-0 hidden z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative w-full max-w-4xl rounded-lg shadow bg-white">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 ">Registrar Historial de Cómputo</h3>
                    <button type="button"
                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="modalRegistar">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form method="POST" id="formRegistrarHistorial" action="{{ route('historial.store') }}">
                        @csrf

                        <!-- Producto -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Producto -->
                            <div class="mb-4">
                                <label for="producto_id" class="block text-sm font-medium text-gray-700">Producto</label>
                                <input type="text" name="producto_id" id="producto_id"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    required>
                            </div>

                            <!-- Marca -->
                            <div class="mb-4">
                                <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                                <input type="text" name="marca" id="marca"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Modelo -->
                            <div class="mb-4">
                                <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text" name="modelo" id="modelo"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Hostname -->
                            <div class="mb-4">
                                <label for="hostname" class="block text-sm font-medium text-gray-700">Hostname</label>
                                <input type="text" name="hostname" id="hostname"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Tipo de Equipo -->
                            <div class="mb-4">
                                <label for="t_equipo" class="block text-sm font-medium text-gray-700">Tipo de Equipo</label>
                                <input type="text" name="t_equipo" id="t_equipo"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Serial -->
                            <div class="mb-4">
                                <label for="serial" class="block text-sm font-medium text-gray-700">Serial</label>
                                <input type="text" name="serial" id="serial"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Procesador -->
                            <div class="mb-4">
                                <label for="procesador" class="block text-sm font-medium text-gray-700">Procesador</label>
                                <input type="text" name="procesador" id="procesador"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Disco -->
                            <div class="mb-4">
                                <label for="disco" class="block text-sm font-medium text-gray-700">Disco</label>
                                <input type="text" name="disco" id="disco"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Disco 2 -->
                            <div class="mb-4">
                                <label for="disco2" class="block text-sm font-medium text-gray-700">Disco 2</label>
                                <input type="text" name="disco2" id="disco2"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>
                        </div>

                        <!-- Columna 2: RAM, Sistema Instalado, Licencias, Sistema Operativo, Licencia, Antivirus, Versión Licencia -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- RAM -->
                            <div class="mb-4">
                                <label for="ram" class="block text-sm font-medium text-gray-700">RAM</label>
                                <input type="text" name="ram" id="ram"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Sistema Instalado -->
                            <div class="mb-4">
                                <label for="s_instalado" class="block text-sm font-medium text-gray-700">Software
                                    Instalado</label>
                                <input type="text" name="s_instalado" id="s_instalado"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Licencias -->
                            <div class="mb-4">
                                <label for="licencias" class="block text-sm font-medium text-gray-700">Licencias</label>
                                <input type="text" name="licencias" id="licencias"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Sistema Operativo -->
                            <div class="mb-4">
                                <label for="s_operativo" class="block text-sm font-medium text-gray-700">Sistema
                                    Operativo</label>
                                <input type="text" name="s_operativo" id="s_operativo"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Licencia -->
                            <div class="mb-4">
                                <label for="licencia" class="block text-sm font-medium text-gray-700">Licencia</label>
                                <input type="text" name="licencia" id="licencia"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Antivirus -->
                            <div class="mb-4">
                                <label for="antivirus" class="block text-sm font-medium text-gray-700">Antivirus</label>
                                <input type="text" name="antivirus" id="antivirus"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Versión Licencia -->
                            <div class="mb-4">
                                <label for="version_licencia" class="block text-sm font-medium text-gray-700">Versión
                                    Licencia</label>
                                <input type="text" name="version_licencia" id="version_licencia"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                            </div>

                            <!-- Fecha de Registro -->
                            <div class="mb-4">
                                <label for="fecha_registro" class="block text-sm font-medium text-gray-700">Fecha de
                                    Registro</label>
                                <input type="date" name="fecha_registro" id="fecha_registro"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado"
                                class="mt-1 block rounded-md border-2 border-gray-300 shadow-sm">
                                <option value="">Seleccionar</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Activado">Activo</option>
                                {{-- <option value="Retiro">Retiro</option> --}}
                            </select>
                        </div>

                        <!-- Observaciones -->
                        <div class="mb-4">
                            <label for="observaciones"
                                class="block text-sm font-medium text-gray-700">Observaciones</label>
                            <textarea name="observaciones" id="observaciones"
                                class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm" rows="4"></textarea>
                        </div>



                        <!-- Botones -->
                        <div class="w-full flex justify-between mt-4">
                            <button type="submit"
                                class="w-1/3 bg-red-800 text-white py-2 rounded-md shadow-sm hover:bg-red-600">Registrar</button>
                            <button type="button" class="w-1/3 bg-gray-300 text-black py-2 rounded-md shadow-sm"
                                data-modal-hide="modalRegistar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div data-dial-init class="fixed end-6 bottom-6 group">
        <div id="speed-dial-menu-default" class="hidden mb-4 space-y-2">
            <div class="flex flex-col items-center">
                <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left"
                    id="modalHistorialExperto"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 shadow-sm hover:bg-gray-50">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Descargar</span>
                </button>
                <div id="tooltip-download" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Descargar
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <button type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left"
                    id="modalHistori"
                    class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 shadow-sm hover:bg-gray-50">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5h7.586l-.293.293a1 1 0 0 0 1.414 1.414l2-2a1 1 0 0 0 0-1.414l-2-2a1 1 0 0 0-1.414 1.414l.293.293H4V9h5a2 2 0 0 0 2-2Z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="sr-only">Importar</span>
                </button>
                <div id="tooltip-copy" role="tooltip"
                    class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Importar
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-default" aria-controls="speed-dial-menu-default"
            aria-expanded="false"
            class="flex items-center justify-center text-white bg-red-700 rounded-full w-14 h-14 hover:bg-red-800  focus:ring-4">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>

    <div id="importarHistorial" class="fixed inset-0 hidden z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative w-full max-w-lg rounded-lg shadow bg-white">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Importar historial computo
                    </h3>
                    <button type="button"
                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-historial="importarHistorial">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form method="POST" id="formImportarHistorial" action="{{ route('import.historial') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="archivo_csv" class="block text-sm font-medium leading-6 text-gray-900">Archivo
                                CSV</label>
                            <div class="mt-2">
                                <input type="file" name="archivo_csv_historial" id="archivo_csv" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            </div>
                            <br>
                            <a href="{{ asset('plantillas/HISTORIAL-COMPUTO-PLANTILLA.csv') }}" 
                                class="text-blue-600 hover:underline dark:text-blue-500">Plantilla CSV - Historial
                                computo</a>
                        </div>
                        <div class="w-full flex justify-between mt-4">
                            <button type="submit"
                                class="w-1/3 bg-red-800 text-white py-2 rounded-md shadow-sm hover:bg-red-600">Importar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="ExportHistorial" class="fixed inset-0 hidden z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative w-full max-w-lg rounded-lg shadow bg-white">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Exportar historial computo
                    </h3>
                    <button type="button"
                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-export="ExportHistorial">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form method="POST" id="formExportHistorial" action="{{ route('historial.export') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="fecha_inicial" class="block text-sm font-medium leading-6 text-gray-900">Fecha
                                inicial</label>
                            <div class="mt-2">
                                <input type="date" name="fecha_inicial" id="fecha_inicial" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            </div>
                            <br>
                            <label for="fecha_final" class="block text-sm font-medium leading-6 text-gray-900">Fecha
                                final</label>
                            <div class="mt-2">
                                <input type="date" name="fecha_final" id="fecha_final" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="w-full flex justify-between mt-4">
                            <button type="submit"
                                class="w-1/3 bg-red-800 text-white py-2 rounded-md shadow-sm hover:bg-red-600">Importar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            //seleccionamos los codigo internos de los pc, que se llaman atraves del controlador de historial
            var codigoInternos = @json($codigosInternos);

            // Autocompletado con jQuery UI
            $("#producto_id").autocomplete({
                source: codigoInternos
            });
        });
    </script>
@endsection
