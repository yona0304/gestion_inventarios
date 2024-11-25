@extends('layouts.layout')

@section('title', 'Equipos Alquilados - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4 bg-white">
                    <label for="BuscarAlquiler" class="sr-only">Search</label>
                    <div class="flex items-center justify-between ">
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="BusAlquiler"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50"
                                placeholder="Buscar por profesional">
                        </div>
                        <div class="mt-1">
                            <button id="modalmport"
                                class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                type="button">
                                Importar CSV
                            </button>
                        </div>
                    </div>
                </div>
                <div id="TablaEquiposAlquilados">
                    @include('partials.alquilados')
                </div>

            </div>
        </div>
        <!-- Main modal -->
    </div>
    <div id="modalImportarCSV" class="fixed inset-0 hidden z-50 overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative w-full max-w-lg rounded-lg shadow bg-white">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Importar lista de equipos alquilados
                    </h3>
                    <button type="button"
                        class="text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="modalImportarCSV">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form method="POST" id="formImportarCSV" action="{{ route('alquiler.import') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="archivo_csv" class="block text-sm font-medium leading-6 text-gray-900">Archivo
                                CSV</label>
                            <div class="mt-2">
                                <input type="file" name="archivo_csv" id="archivo_csv" required
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
@endsection
