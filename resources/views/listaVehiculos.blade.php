@extends('layouts.layout')

@section('title', 'Lista de vehiculos - INGICAT')

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
    </div>
@endsection
