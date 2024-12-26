@extends('layouts.layout')

@section('title', 'Asignar Equipo')

@section('content')
    <div class="p-4 sm:ml-64">

        <form id="AsigEnvio" action="{{ route('asignar.store') }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-6 mt-5 md:grid-cols-1">
                <div class="mb-5">
                    <h1 class="text-center font-medium text-2xl text-gray-900">Asignar Equipo</h1>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div>
                        <label for="codigo_interno" class="block mb-2 text-base font-medium text-gray-900">Codigo
                            interno <span class="text-red-700">*</span></label>
                        <input type="text" id="codigo_interno" name="codigo_interno"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="codigo interno / placa vehicular" required />
                    </div>

                    <div>
                        <label for="profesional"
                            class="block mb-2 text-base font-medium text-gray-900">ID del Profesional <span class="text-red-700">*</span></label>
                        <input type="text" id="profesional" name="profesional"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Documento del profesional" required />
                    </div>
                </div>

                <div>
                    <label for="ubicacion" class="block mb-2 text-base font-medium text-gray-900">Ubicación <span class="text-red-700">*</span></label>
                    <select id="ubicacion" required name="ubicacion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="">Seleccionar</option>
                        <option value="BARRANCABERMEJA">BARRANCABERMEJA</option>
                        <option value="BOGOTÁ">BOGOTÁ</option>
                        <option value="VILLAVICENCIO">VILLAVICENCIO</option>
                    </select>
                </div>
                <div>
                    <label for="fecha_asignacion" class="block mb-2 text-base font-medium text-gray-900">Fecha
                        Asignación <span class="text-red-700">*</span></label>
                    <input type="date" id="fecha_asignacion" name="fecha_asignacion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        required />
                </div>
                <div>
                    <label for="observaciones" class="block mb-2 text-base font-medium text-gray-900">
                        Observaciones <span class="text-red-700">*</span></label>
                    <textarea id="observaciones" rows="4" name="observaciones"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Escribe tu comentario aqui..."></textarea>
                </div>
            </div>

            <button type="submit"
                class="text-white bg-blue-900 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar</button>
        </form>

    </div>
    <script>
        $(function() {
            //obtenemos los valores de una columna especifica en la cual solo es profesional, ya que el de los productos, lo realizamos en el controlador.
            var profesionales = @json($asignacion->pluck('identificacion'));
            var vehiculo = @json($vehiculos->pluck('placa'));
            var codigoInternos = @json($codigosInternos);
            var referencias = @json($referencias);

            // Autocompletado con jQuery UI
            $("#profesional").autocomplete({
                source: profesionales
            });

            //concatenamos los dos array, para volverlos uno solo
            var todoJunto = codigoInternos.concat(referencias, vehiculo);

            // Autocompletado con jQuery UI
            $("#codigo_interno").autocomplete({
                source: todoJunto
            });
        });
    </script>
@endsection
