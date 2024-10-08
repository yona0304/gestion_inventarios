@extends('layouts.layout')

@section('title', 'Retirar Asignación - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">

        <form id="formDevo">
            @csrf
            <div class="grid gap-4 mb-6 md:grid-cols-1">
                <div>
                    <h1 class="text-center font-medium text-2xl text-gray-900">Devolución Equipo</h1>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="id_producto" class="block mb-2 text-base font-medium text-gray-900">Codigo Item</label>
                        <input type="text" id="id_producto" name="id_producto"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="ej: ING-PC-000" required />
                    </div>
                    <div>
                        <label for="identificacion"
                            class="block mb-2 text-base font-medium text-gray-900">Identicación</label>
                        <input type="text" id="identificacion" name="identificacion"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            placeholder="ej: 123456789" required />
                    </div>
                </div>

                <div class="flex ">
                    <p class="mr-2 font-medium text-gray-900">Nombre Producto:</p>
                    <strong>
                        <p id="nombre_producto" class="text-gray-700"></p>
                    </strong>
                </div>

                <div class="flex ">
                    <p class="mr-2 font-medium text-gray-900">Categoria:</p>
                    <strong>
                        <p id="categoria" class="text-gray-700"></p>
                    </strong>
                </div>

                <div class="flex ">
                    <p class="mr-2 font-medium text-gray-900">Fecha Asignación:</p>
                    <strong>
                        <p id="f_asignacion" class="text-gray-700"></p>
                    </strong>
                </div>

                <div>
                    <label for="fecha_dev" class="block mb-2 text-base font-medium text-gray-900">Fecha
                        Devolución</label>
                    <input type="date" id="fecha_dev" name="fecha_dev"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="ej: 123456789" required />
                </div>

                <div>
                    <label for="novedad" class="block mb-2 text-base font-medium text-gray-900">
                        Novedad</label>
                    <textarea id="novedad" rows="4" name="novedad"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Escribe tu comentario aqui..."></textarea>
                </div>
            </div>


            <button type="submit"
                class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar</button>
        </form>

    </div>

@endsection
