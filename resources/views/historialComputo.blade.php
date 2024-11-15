@extends('layouts.layout')

@section('title', 'Historial Computo - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4 bg-white">
                    <label for="Equipo" class="sr-only">Search</label>
                    <div class="flex items-center justify-between ">
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="Equipo"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50"
                                placeholder="Buscar producto">
                        </div>
                        <div class="mt-1">
                            <button id="mostrarModal"
                                class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                type="button">
                                Ingresar Historial
                            </button>
                        </div>
                    </div>
                </div>
                <div id="Tablalquilados">
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
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">Registrar Historial de Cómputo</h3>
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
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    required>
                            </div>

                            <!-- Modelo -->
                            <div class="mb-4">
                                <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text" name="modelo" id="modelo"
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    required>
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
                                    class="mt-1 block w-full rounded-md border-2 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    required>
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
                            <label for="estado"
                                class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" id="estado" class="mt-1 block rounded-md border-2 border-gray-300 shadow-sm">
                                <option value="">Seleccionar</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                {{-- <option value="Retiro">Retiro</option> --}}
                                {{-- <option value="Activado">Activar</option> --}}
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
