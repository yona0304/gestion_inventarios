@extends('layouts.layout')

@section('title', 'Equipos Alquilados - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4 bg-white">
                    <label for="scope" class="sr-only">Search</label>
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
                        {{-- <div class="mt-1">
                            <button id="modalmport"
                                class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                type="button">
                                Importar CSV
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div id="Tablalquilados">
                    @include('partials.alquilados')
                </div>

            </div>
        </div>
    </div>
@endsection
