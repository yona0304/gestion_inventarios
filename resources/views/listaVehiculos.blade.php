@extends('layouts.layout')

@section('title', 'Lista de vehiculos')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="pb-4 bg-white">
                    <label for="vehiculo" class="sr-only">Search</label>
                    <div class="flex items-center justify-between ">
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="vehiculo"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50"
                                placeholder="Buscar placa de vehiculo">
                        </div>

                    </div>
                </div>
                <div id="listaVehiculos">
                    @include('partials.vehiculos')
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="detalleVehiculoModal"
            class="fixed top-0 left-0 z-50 hidden w-full h-full p-4  bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="flex items-center justify-center">
                <div
                    class="relative w-full max-w-2xl md:h-auto bg-white rounded-lg shadow overflow-y-auto max-h-[90vh]">
                    <!-- Modal content -->
                    <div class="relative">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Detalles de asignación
                            </h3>
                            <button type="button"
                                class="close-vehiculo-btn text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
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
                                <p><span class="font-semibold">Nombre:</span> <span id="NombreVehiculo"></span> </p>
                                <p><span class="font-semibold">Identificación:</span> <span
                                        id="IdentificacionVehiculo"></span></p>
                                <p><span class="font-semibold">Ubicación:</span> <span id="VehiculoUbicacion"></span> </p>
                                <p class="break-words"><span class="font-semibold">Correo Electrónico:</span> <span
                                        id="VehiculoCorreo"></span> </p>
                                <p><span class="font-semibold">Cargo:</span> <span id="VehiculoCargo"></span> </p>
                            </div>

                            <!-- Datos asignación -->
                            <h4 class="font-bold text-gray-700">
                                Datos Asignación
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <p><span class="font-semibold">Lugar:</span> <span id="VehiculoLugar"></span> </p>
                                <p><span class="font-semibold">Fecha asignación:</span> <span
                                        id="VehiculoFechaAsignacion"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
