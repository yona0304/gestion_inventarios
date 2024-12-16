@extends('layouts.layout')

@section('title', 'Registro dotaciones - INGICAT')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="container mt-10">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-3 md:grid-cols-2">
            <div>
                <form id="DotacionReg" action="{{route('dotacion.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center font-semibold leading-7 text-gray-900">
                        Registro de dotaciones
                    </h2>
                    <label for="cargo" class="block text-sm font-medium leading-6 text-gray-900">
                        Cargo
                    </label>
                    <div class="mt-2">
                        <select name="cargo" id="cargo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"> >
                            <option value="">SELECCIONAR</option>
                           @foreach ($cargo as $cargos)
                                <option value="{{$cargos->id}}">{{$cargos->cargo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="categorias" class="block text-sm font-medium leading-6 text-gray-900">
                        Producto requerido
                    </label>
                    <div class="mt-2">
                        <select name="categorias" id="categorias" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"> >
                            <option value="">SELECCIONAR</option>
                            @foreach ($categoria as $categorias)
                                <option value="{{$categorias->id}}">{{$categorias->nombre_categoria}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex items-center justify-end ">
                        <button type="submit"
                            class="rounded-md bg-red-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                            Registrar</button>
                    </div>
                </form>

            </div>
            <div>
                <div class="mt-8 overflow-x-auto">
                    <div class="form-group col-md-5 col-md-offset-7">
                        <input type="text" id="BusDota"
                        placeholder="Buscar dotación por cargo"
                        class="mt-2 block w-full max-w-xs text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 p-2">
                    </div>
                    <div id="tablaDonaciones">
                        @include('partials.dotaciones')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
