@extends('layouts.layout')

@section('title', 'Registrar Producto')

@section('content')
    <div class="p-4 sm:ml-64">
        <form id="ProductoEnvio" class="mx-auto" method="POST" action="{{ route('registrar.store') }}">
            @csrf
            <div class="max-w-sm mx-auto">
                <label for="catgoria" class="block mb-2 text-sm font-medium text-gray-900">Seleccionar categoria</label>
                <select id="categoria" name="categoria"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-blue-500 block w-full p-2.5">
                    <option value="">Seleccionar</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->id }} - {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>

            <div class="flex items-center space-x-2 mb-5">
                <div>
                    <span class="block mb-2 text-sm font-medium text-gray-900">Prefijo</span>
                    <p id="prefijo_categoria"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-24 p-2.5"></p>
                </div>
                <div>
                    <label for="contador" class="block mb-2 text-sm font-medium text-gray-900">Contador <span class="text-red-700">*</span></label>
                    <input type="number" id="contador" name="contador"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-24 p-2.5" required
                        placeholder="1,2,3,4,5">
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">Descripción de
                    equipo <span class="text-red-700">*</span></label>
                <textarea id="descripcion" rows="4" name="descripcion" placeholder="LENOVO LEGION..."
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300" required></textarea>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="codigo_referencia"
                        class="block mb-2 text-sm font-medium text-gray-900">Codigo /
                        Referencia <span class="text-red-700">*</span></label>
                    <input type="text" id="codigo_referencia" name="codigo_referencia" placeholder="CCP001"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        required>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="ubicacion"
                        class="block mb-2 text-sm font-medium text-gray-900">Ubicación <span class="text-red-700">*</span></label>
                    <select id="ubicacion" name="ubicacion" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-blue-500 block w-full p-2.5">
                        <option value="">Seleccionar</option>
                        <option value="BARRANCABERMEJA">BARRANCABERMEJA</option>
                        <option value="BOGOTÁ">BOGOTÁ</option>
                        <option value="VILLAVICENCIO">VILLAVICENCIO</option>
                    </select>
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900">Observaciones
                    <span class="text-red-700">(opcional)</span></label>
                <textarea id="observacion" rows="4" name="observacion" placeholder="observaciones presentadas al registrar..."
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
            </div>

            <button type="submit" disabled
                class="text-white bg-blue-900 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar</button>
        </form>

    </div>
    <script src="{{ asset('js/registrarProducto.js') }}"></script>
@endsection
