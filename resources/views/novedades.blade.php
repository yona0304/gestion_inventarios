@extends('layouts.layout')

@section('title', 'Registro de dotacion - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <form id="novedad" action="{{ route('novedad.store') }}" method="POST">
            @csrf
            <div>
                <div class="my-6 w-full text-center text-lg">
                    <h1><strong>Registro de novedades </strong></h1>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="producto"
                            class="block mb-2 text-sm font-medium text-gray-900">Codigo</label>
                        <input type="text" id="producto" name="producto" placeholder="UT-PC-001, UT-M-001..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="fecha"
                            class="block mb-2 text-sm font-medium text-gray-900">Fecha</label>
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
                            class="block mb-2 text-sm font-medium text-gray-900">Descripcion</label>
                        <textarea id="descripcion" name="descripcion" placeholder="Escribe tu comentario aqui..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required></textarea>
                    </div>
                </div>
                <div id="additionalFields" class="hidden space-y-4">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="ubicacion_new"
                            class="block mb-2 text-sm font-medium text-gray-900">Destino</label>
                        <select type="text" id="ubicacion_new" name="ubicacion_new"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required>
                            <option value="null">Seleccionar</option>
                            <option value="Bogota">Bogota</option>
                            <option value="Barrancabermeja">Barrancabermeja</option>
                        </select>
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
    <script>
        $(function() {
            //obtenemos los valores de una columna especifica en la cual solo es profesional, ya que el de los productos, lo realizamos en el controlador.
            var codigoInternos = @json($codigosInternos);

            var vehiculo = @json($vehiculos->pluck('placa'));

            var referencias = @json($referencias);

            var todoJunto = codigoInternos.concat(referencias, vehiculo);

            $("#producto").autocomplete({
                source: todoJunto
            });
        });

        document.getElementById('tipo_novedad').addEventListener('change', function() {
            const additionalFields = document.getElementById('additionalFields');
            if (this.value === 'Traslado') {
                additionalFields.classList.remove('hidden');
            } else {
                additionalFields.classList.add('hidden');
            }
        });
    </script>

@endsection
