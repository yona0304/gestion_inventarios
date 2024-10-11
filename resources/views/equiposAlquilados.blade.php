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
                            <input type="text" id="BuscarAlquiler"
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
                <div id="Tablalquilados">
                    @include('partials.alquilados')
                </div>

            </div>
        </div>
        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 justify-center items-center w-full h-full">
            <div class="modal-content relative bg-white rounded-lg shadow">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Importar lista de equipos alquilados
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>
                    </div>
                    <h6>Recordar que el archivo tiene que ser en utf8(limitado por comas)</h6>
                    <!-- Modal body -->
                    <form id="ImportProducto" class="p-4 md:p-5" action="" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="document_csv" class="block text-sm font-medium text-gray-700">Subir Archivo
                                    CSV </label>
                                <input type="file" name="document_csv" id="document_csv"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2"
                                    required="">
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2 text-center">
                            Registrar productos
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
