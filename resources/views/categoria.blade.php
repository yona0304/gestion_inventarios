@extends('layouts.layout')

@section('title', 'Registrar Producto - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-3 md:grid-cols-2">
                <div>
                    <form id="CategoriaEnvio" action="{{ route('categoria.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-center font-semibold leading-7 text-gray-900">Registrar categoria</h2>
                        <label for="categoria" class="block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                        <div class="mt-2">
                            <input type="text" name="categoria" id="categoria" autocomplete="off" required
                                placeholder="ej: MONITOR"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>

                        <label for="prefijo" class="block text-sm font-medium leading-6 text-gray-900">Prefijo</label>
                        <div class="mt-2">
                            <input type="text" name="prefijo" id="prefijo" autocomplete="off" required
                                placeholder="ej: UT-PC / UT-KIT"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>

                        <div class="mt-6 flex items-center justify-end ">
                            <button type="submit"
                                class="rounded-md bg-red-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                Registrar</button>
                        </div>
                    </form>

                </div>
                <div>
                    <div class="mt-8 overflow-x-auto">
                        <div class="form-group col-md-5 col-md-offset-7">
                            <input type="text" id="BusCategoria" placeholder="buscar por categoria o prefijo"
                                class="mt-2 block w-full max-w-xs text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 p-2">
                        </div>
                        <div id="divTable">
                            @include('partials.categorias')
                        </div>
                    </div>
                </div>
                @isset($selectCategoriaDesactivado)
                    <td class="px-6 py-4">
                        <button id="showTableBtn" class="bg-red-500 text-white px-3 py-1 rounded-md">
                            Mostrar categorias desactivadas
                        </button>
                    </td>

                    <!-- Modal -->
                    <div id="tableModal"
                        class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
                            <!-- Encabezado del modal -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold">Productos Desactivados</h2>
                                <button id="hideTableBtn" class="text-gray-500 hover:text-red-500">
                                    &times;
                                </button>
                            </div>
                            <div class="overflow-x-auto ">
                                <!-- Tabla -->
                                <table class="min-w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                                    <thead class="bg-gray-200 text-gray-700">
                                        <tr>
                                            <th class="border px-6 py-3 text-left uppercase font-semibold">Nombre</th>
                                            <th class="border px-6 py-3 text-left uppercase font-semibold">Prefijo</th>
                                            <th class="border px-6 py-3 text-left uppercase font-semibold">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($selectCategoriaDesactivado as $cats)
                                            <tr class="hover:bg-gray-100">
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $cats->nombre_categoria }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $cats->prefijo }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <button
                                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md transition duration-200 ease-in-out"
                                                        onclick="activeCategoria('{{ $cats->id }}')">
                                                        Reactivar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endisset
                <!-- Script para manejar el modal -->
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
            </div>
        </div>
    </div>
@endsection
