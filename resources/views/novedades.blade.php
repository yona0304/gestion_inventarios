@extends('layouts.layout')

@section('title', 'Registro de dotacion - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <form id="novedad" action="{{ route('novedad.store') }}" method="POST">
            @csrf
            <div>
                <div class="my-6 w-full text-center text-lg">
                    <h1 ><strong>Registro de novedades </strong></h1>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="producto"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Codigo</label>
                        <input type="text" id="producto" name="producto"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="fecha"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha</label>
                        <input type="date" id="fecha" name="fecha"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="tipo_novedad" class="block mb-2 text-base font-medium text-gray-900">Tipo
                            de novedad</label>
                        <select name="tipo_novedad" id="tipo_novedad" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="">Seleccionar</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="Activo">Fin del mantenimiento</option>
                            <option value="Traslado"> Traslado </option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <textarea id="descripcion" name="descripcion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required></textarea>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div>
                    <button type="submit"
                        class="mt-4 w-full bg-red-700 text-white font-semibold rounded-lg p-2 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-blue-400">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @endsection
