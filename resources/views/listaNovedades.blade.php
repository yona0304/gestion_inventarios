@extends('layouts.layout')

@section('title', 'Lista de novedades - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="grid grid-cols-6 gap-4 p-2 border  border-gray-300 w-full text-sm text-left rtl:text-right text-gray-500"
                    style="overflow: auto; max-width:3000px;min-width:890px;">
                    <!-- Filtro Producto -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusNoveProducto" placeholder="Producto" class="w-full text-xs">
                    </div>
                    <!-- Filtro Profesional -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusNoveProfesional" placeholder="Profesional" class="w-full text-xs">
                    </div>
                    <!-- Filtro Descripción (ocupa dos columnas) -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <p>Descripcion</p>
                    </div>
                    <!-- Filtro Fecha -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="date" id="BusNoveFecha" class="w-full text-xs text-gray-400"
                            oninput="this.classList.toggle('text-black', this.value !== ''); this.classList.toggle('text-gray-400', this.value === '');">
                    </div>
                    <!-- Filtro Ubicación -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusNoveTipo" placeholder="T. Novedad" class="w-full text-xs">
                    </div>
                    <!-- Filtro Estado -->
                    <div class="p-1 text-gray-900 border border-gray-300 rounded-lg bg-gray-50">
                        <input type="text" id="BusNoveEstado" placeholder="Estado" class="w-full text-xs">
                    </div>
                </div>


                {{-- tabla con datos --}}
                <div id="TablaNovedades">

                    @include('partials.novedades')
                </div>

            </div>
        </div>
    </div>
@endsection
