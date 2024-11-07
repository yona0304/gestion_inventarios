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
    </div>
@endsection
