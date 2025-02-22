@extends('layouts.layout')

@section('title', 'Registrar Vehiculo')

@section('content')
    <div class="p-4 sm:ml-64">

        <form id="VehiculoEnvio" action="{{ route('vehiculo.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="color" class="block mb-2 text-sm font-medium text-gray-900">Color <span class="text-red-700">*</span></label>
                    <input type="text" id="color" name="color" placeholder="GRIS"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="llave" class="block mb-2 text-sm font-medium text-gray-900">Llave <span class="text-red-700">*</span></label>
                    <input type="text" id="llave" name="llave" placeholder="Manos libre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="terpel" class="block mb-2 text-sm font-medium text-gray-900">Terpel <span class="text-red-700">*</span></label>
                    <input type="text" id="terpel" name="terpel" placeholder="Si"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="placa" class="block mb-2 text-sm font-medium text-gray-900">Placa <span class="text-red-700">*</span></label>
                    <input type="text" id="placa" name="placa" placeholder="G1060C"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción de
                        vehiculo <span class="text-red-700">*</span></label>
                    <input type="text" id="descripcion" name="descripcion_vehiculo" placeholder="CAMIONETA 4X4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="traccion" class="block mb-2 text-sm font-medium text-gray-900">Tracción <span class="text-red-700">*</span></label>
                    <input type="text" id="traccion" name="traccion" placeholder="SI"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="modelo" class="block mb-2 text-sm font-medium text-gray-900">Modelo <span class="text-red-700">*</span></label>
                    <input type="text" id="modelo" name="modelo" placeholder="RAV4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="proveedor" class="block mb-2 text-sm font-medium text-gray-900">Proveedor /
                        Contratante <span class="text-red-700">*</span></label>
                    <input type="text" id="proveedor" name="proveedor" placeholder="EMPRESA O PERSONA"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="tipo_proveedor" class="block mb-2 text-sm font-medium text-gray-900">Tipo
                        Proveedor <span class="text-red-700">*</span></label>
                    <input type="text" id="tipo_proveedor" name="tipo_proveedor" placeholder="UNICO"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="valor" class="block mb-2 text-sm font-medium text-gray-900">Valor
                        Contratado <span class="text-red-700">*</span></label>
                    <input type="number" id="valor" name="valor" placeholder="250000"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                <div>
                    <label for="fecha_entrega" class="block mb-2 text-sm font-medium text-gray-900">Fecha
                        entrega proveedor <span class="text-red-700">*</span></label>
                    <input type="date" id="fecha_entrega" name="fecha_entrega"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div>
                {{-- <div>
                    <label for="fecha_devolucion" class="block mb-2 text-sm font-medium text-gray-900">Fecha
                        devolución proveedor <span class="text-red-700">*</span></label>
                    <input type="date" id="fecha_devolucion" name="fecha_devolucion"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2" />
                </div> --}}
            </div>
            <button type="submit"
                class="text-white bg-blue-900 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar
                vehiculo</button>
        </form>

    </div>
@endsection
