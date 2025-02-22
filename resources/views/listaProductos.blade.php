@extends('layouts.layout')

@section('title', 'Lista de productos')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="grid grid-cols-6 gap-4 p-2 border  border-gray-300 w-full text-sm text-left rtl:text-right text-gray-500"
                    style="overflow: auto; max-width:3000px;min-width:710px;">
                    <!-- Filtro Producto -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuCategoria" placeholder="Buscar categoria" class="w-full text-xs">
                    </div>
                    <!-- Filtro Profesional -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuInterno" placeholder="Buscar interno" class="w-full text-xs">
                    </div>
                    <!-- Filtro Fecha -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuEquipo" placeholder="Buscar equipo" class="w-full text-xs">
                    </div>
                    <!-- Filtro Descripción (ocupa dos columnas) -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuUbicacion" placeholder="Buscar ubicacion" class="w-full text-xs">
                    </div>
                    <!-- Filtro Ubicación -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuReferencia" placeholder="Buscar referencia" class="w-full text-xs">
                    </div>
                    <!-- Filtro Estado -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BuEstado" placeholder="Buscar estado" class="w-full text-xs">
                    </div>
                </div>

                <div id="TablaProduct">
                    @include('partials.productos')
                </div>

            </div>

        </div>

        <!-- Modal -->
        <div id="detalleProductoModal"
            class="fixed top-0 left-0 z-50 hidden w-full h-full p-4  bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="flex items-center justify-center">
                <div class="relative w-full max-w-2xl md:h-auto bg-white rounded-lg shadow overflow-y-auto max-h-[90vh]">
                    <!-- Modal content -->
                    <div class="relative">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Detalles de asignación
                            </h3>
                            <button type="button"
                                class="close-producto-btn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
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

                            <!-- Datos del profesional -->
                            <h4 class="font-bold text-gray-700">
                                Datos Profesional Asignado
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p><span class="font-semibold">Nombre:</span> <span id="NombreAsignacion"></span> </p>
                                <p><span class="font-semibold">Identificación:</span> <span
                                        id="IdentificacionAsignacion"></span></p>
                                <p><span class="font-semibold">Ubicación:</span> <span id="AsignacionUbicacion"></span> </p>
                                <p class="break-words"><span class="font-semibold">Correo Electrónico:</span> <span
                                        id="AsignacionCorreo"></span> </p>
                                <p><span class="font-semibold">Cargo:</span> <span id="AsignacionCargo"></span> </p>
                            </div>

                            <!-- Datos asignación -->
                            <h4 class="font-bold text-gray-700">
                                Datos Asignación
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p><span class="font-semibold">Lugar:</span> <span id="AsinacionLugar"></span> </p>
                                <p><span class="font-semibold">Fecha asignación:</span> <span
                                        id="AsignacionFechaAsignacion"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::check() && Auth::user()->rol === 'Super_Admin')
            <button id="showTableBtn" class="bg-blue-900 text-white px-3 py-1 rounded-md mt-5 hover:bg-blue-700">
                Mostrar productos desactivados
            </button>
            <div id="tableModal" class="fixed  inset-0 hidden z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
                    <!-- Encabezado del modal -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Productos Desactivados</h2>
                        <button id="hideTableBtn" class="text-gray-500 hover:text-red-500">
                            &times;
                        </button>
                    </div>
                    <!-- Tabla -->
                    <div class="overflow-x-auto ">
                        <table class="min-w-full  border border-gray-300 shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-200 text-gray-700">
                                <tr>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Nombre</th>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Codigo interno</th>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Descripcion</th>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Ubicacion</th>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Referencia</th>
                                    <th class="border px-6 py-3 text-left uppercase font-semibold">Accion</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($desProd as $cats)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $cats->categoria->nombre_categoria ?? 'Desconocido' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cats->codigo_interno }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cats->descripcion_equipo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cats->ubicacion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $cats->codigo_equipo_referencia }}</td>
                                        <td class="px-6 py-4">
                                            <button
                                                class="bg-blue-900 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200 ease-in-out"
                                                onclick="activeProducto('{{ $cats->id }}')">
                                                Reactivar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        const showTableBtn = document.getElementById('showTableBtn');
        const hideTableBtn = document.getElementById('hideTableBtn');
        const tableModal = document.getElementById('tableModal');

        // Mostrar la tabla/modal
        showTableBtn.addEventListener('click', () => {
            tableModal.classList.remove('hidden');
        });

        // Ocultar la tabla/modal
        hideTableBtn.addEventListener('click', () => {
            tableModal.classList.add('hidden');
        });

        // Cerrar modal al hacer clic fuera
        window.addEventListener('click', (e) => {
            if (e.target === tableModal) {
                tableModal.classList.add('hidden');
            }
        });
    </script>
@endsection
