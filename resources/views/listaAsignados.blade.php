@extends('layouts.layout')

@section('title', 'Lista de asignados - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                        <tr>
                            <th scope="col" class=" py-3">
                                <input type="text" id="BusProducto" placeholder="Buscar producto"
                                    class=" p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                            </th>
                            <th scope="col" class=" py-3">
                                <input type="text" id="BusProfesional" placeholder="Buscar profesional"
                                    class=" p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                            </th>
                            <th scope="col" class=" py-3">
                                <input type="date" id="BusFecha"
                                    class="p-1 border border-gray-300 rounded-lg bg-gray-50 text-xs text-gray-400"
                                    oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                            </th>
                            <th scope="col" colspan="2" class="py-3 w-full h-full ">Descripcion</th>
                            <th scope="col" class=" py-3">
                                <input type="text" id="BusUbicacion" placeholder="Buscar ubicación"
                                    class=" p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                            </th>
                            <th scope="col" class=" py-3">
                                <input type="text" id="BusEstado" placeholder="Buscar estado"
                                    class=" p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs">
                            </th>
                            <th scope="col" class=" py-3">
                                <input type="date" id="BusDevolucion"
                                    class="p-1 border border-gray-300 rounded-lg bg-gray-50 text-xs text-gray-400"
                                    oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                            </th>
                        </tr>
                    </thead>
                </table> --}}
                <div class="grid grid-cols-8 gap-4 p-2 border  border-gray-300 w-full text-sm text-left rtl:text-right text-gray-500"
                    style="overflow: auto; max-width:3000px;min-width:890px;">
                    <!-- Filtro Producto -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusProducto" placeholder="Buscar producto" class="w-full text-xs">
                    </div>
                    <!-- Filtro Profesional -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusProfesional" placeholder="Buscar profesional" class="w-full text-xs">
                    </div>
                    <!-- Filtro Fecha -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="date" id="BusFecha" class="w-full text-xs text-gray-400"
                            oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                    </div>
                    <!-- Filtro Descripción (ocupa dos columnas) -->
                    <div class=" col-span-2 p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <p>Descripcion</p>
                    </div>
                    <!-- Filtro Ubicación -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusUbicacion" placeholder="Buscar ubicación" class="w-full text-xs">
                    </div>
                    <!-- Filtro Estado -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusEstado" placeholder="Buscar estado" class="w-full text-xs">
                    </div>
                    <!-- Filtro Devolución -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="date" id="BusDevolucion" class="w-full text-xs text-gray-400"
                            oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                    </div>
                </div>


                {{-- tabla con datos --}}
                <div id="TablaAsignado">

                    @include('partials.asignaciones')
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div id="detalleModal"
            class="fixed top-0 left-0 z-50 hidden w-full h-full p-4  bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="flex items-center justify-center">
                <div
                    class="relative w-full max-w-2xl md:h-auto bg-white rounded-lg shadow dark:bg-gray-800 overflow-y-auto max-h-[90vh]">
                    <!-- Modal content -->
                    <div class="relative">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detalles de asignación
                            </h3>
                            <button type="button"
                                class="close-modal-btn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <!-- Datos del producto -->
                            <h4 class="font-bold text-gray-700 dark:text-white">
                                Datos Generales Producto
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p class="break-words"><span class="font-semibold">Producto:</span> <span
                                        id="DeProducto"></span> </p>
                                <p class="break-words"><span class="font-semibold">Código/Placa:</span> <span
                                        id="DeCodigo"></span> </p>
                                <p><span class="font-semibold">Sede:</span> <span id="DeSede"></span> </p>
                                <p><span class="font-semibold">Estado Equipo:</span> <span id="DeEstado"></span> </p>
                            </div>

                            <!-- Datos del profesional -->
                            <h4 class="font-bold text-gray-700 dark:text-white">
                                Datos Profesional Asignado
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p><span class="font-semibold">Nombre:</span> <span id="DeNombre"></span> </p>
                                <p><span class="font-semibold">Identificación:</span> <span id="DeIdentificacion"></span>
                                </p>
                                <p><span class="font-semibold">Ubicación:</span> <span id="DeUbicacion"></span> </p>
                                <p class="break-words"><span class="font-semibold">Correo Electrónico:</span> <span
                                        id="DeCorreo"></span> </p>
                                <p><span class="font-semibold">Cargo:</span> <span id="DeCargo"></span> </p>
                            </div>

                            <!-- Datos asignación -->
                            <h4 class="font-bold text-gray-700 dark:text-white">
                                Datos Asignación
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p><span class="font-semibold">Lugar:</span> <span id="DeLugar"></span> </p>
                                <p><span class="font-semibold">Fecha asignación:</span> <span id="DeFechaAsignacion"></span>
                                </p>
                                <p><span class="font-semibold">Fecha devolución:</span> <span id="DeFechaDevolucion"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
