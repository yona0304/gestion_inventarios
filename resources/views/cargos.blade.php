@extends('layouts.layout')

@section('title', 'Registrar Producto - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-3 md:grid-cols-2">
            <div>
                <form id="CargoEnvio" action="{{ route('cargo.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center font-semibold leading-7 text-gray-900">Registrar cargo de perfil</h2>
                    <label for="cargo" class="block text-sm font-medium leading-6 text-gray-900">Cargo</label>
                    <div class="mt-2">
                        <input type="text" name="cargo" id="cargo" autocomplete="off" required
                            placeholder="ej: COORDINADOR TECNICO"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                    </div>

                    <div class="mt-6 flex items-center justify-end ">
                        <button type="submit"
                            class="rounded-md bg-red-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                            Registrar</button>
                    </div>
                </form>

                {{-- <form id="mensajeFn" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col items-center justify-center">
                        <label for="document_csv" class="block text-sm font-medium text-gray-700">Subir Archivo
                            CSV</label>
                        <input id="document_csv" type="file" name="document_csv" required
                            class="mt-2 block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-500 file:text-white hover:file:bg-red-600" />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="mt-4 rounded-md bg-red-800 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                            Importar CARGOS
                        </button>
                    </div>
                </form> --}}


            </div>
            {{-- <div>
                <div class="mt-8 overflow-x-auto">
                    <div class="form-group col-md-5 col-md-offset-7">
                        <input type="text" id="scope" placeholder="ej: COORDINADOR TECNICO"
                            class="mt-2 block w-full max-w-xs text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 p-2">
                    </div>
                    <div id="divTable">
                    </div>
                </div>
            </div> --}}
            {{-- @include('partials.table') --}}
        </div>
    </div>
@endsection
