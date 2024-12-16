@extends('layouts.layout')

@section('title', 'Alquiler Equipo - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">

        <div class="container mt-10">
            <form id="FormAlquiler" action="{{ route('alquiler.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-6 md:grid-cols-1">
                    <div>
                        <h1 class="text-center mb-8 font-medium text-2xl text-gray-900">Alquiler Equipo</h1>
                    </div>

                    <div class="grid gap-8 mb-6 md:grid-cols-2">
                        <div>
                            <div>
                                <label for="tipo_equipo" class="block mb-1 text-base font-medium text-gray-900">Tipo
                                    Equipo</label>
                                <select name="tipo_equipo" id="tipo_equipo" required
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Seleccionar</option>
                                    <option value="GPS">GPS</option>
                                    <option value="CELULAR">CELULAR</option>
                                    <option value="PORTATIL">PORTÁTIL</option>
                                </select>
                                {{-- <input type="text" id="tipo_equipo" name="tipo_equipo"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="ej: MONITOR, PORTATIL, GPS.." required /> --}}
                            </div>

                            <div>
                                <label for="descripcion_equipo"
                                    class="block mb-1 text-base font-medium text-gray-900">Descripción
                                    Equipo</label>
                                <input type="text" id="descripcion_equipo" name="descripcion_equipo"
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="ej: Portátil marca lenovo" required />
                            </div>

                            <div>
                                <label for="valor_contratado" class="block mb-1 text-base font-medium text-gray-900">Valor
                                    Contratado</label>
                                <input type="number" id="valor_contratado" name="valor_contratado"
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="ej: 1500000" required />
                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="profesional"
                                    class="block mb-1 text-base font-medium text-gray-900">ID del Profesional</label>
                                <input type="number" id="profesional" name="profesional"
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Documento del profesional" required />
                            </div>

                            <div>
                                <label for="ubicacion" class="block mb-1 text-base font-medium text-gray-900">
                                    Ubicación</label>
                                <input type="text" id="ubicacion" name="ubicacion"
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="ej: Barrancabermeja" required />
                            </div>

                            <div>
                                <label for="fecha_inici_alquiler" class="block mb-1 text-base font-medium text-gray-900">
                                    Fecha Alquiler</label>
                                <input type="date" id="fecha_inici_alquiler" name="fecha_inici_alquiler"
                                    class="bg-gray-50 mb-10 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>


                <button type="submit"
                    class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Alquilar</button>
            </form>
        </div>

    </div>
    <script>
        $(function() {
            var usuarios = @json($selecId);

            $('#profesional').autocomplete({
                source: usuarios
            });
        })
    </script>

@endsection
