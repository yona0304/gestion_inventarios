@extends('layouts.layout')

@section('title', 'Registrar Usuario - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <form id="UsuaEnvi" action="{{ route('usuario.store') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <h1 class="text-center font-medium text-2xl text-gray-900">Registrar Personal</h1>
                    </div>
                    <div class="grid md:grid-cols-3 md:gap-6">
                        <div>
                            <label for="identificacion"
                                class="block mb-2 text-base font-medium text-gray-900 ">Identificación</label>
                            <input type="number" id="identificacion" name="identificacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div class="col-span-2">
                            <label for="nombre" class="block mb-2 text-base font-medium text-gray-900 ">Nombre</label>
                            <input type="text" id="nombre" name="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                    </div>

                    <div>
                        <label for="correo" class="block mb-2 text-base font-medium text-gray-900 ">Correo</label>
                        <input type="email" id="correo" name="correo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required />
                    </div>

                    <div class="grid md:grid-cols-3 md:gap-6">
                        <div>
                            <label for="ubicacion" class="block mb-2 text-base font-medium text-gray-900 ">Ubicación</label>
                            <select id="ubicacion" required name="ubicacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">Seleccionar</option>
                                <option value="Barrancabermeja">Barrancabermeja</option>
                                <option value="Bogotá">Bogotá</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="cargo" class="block mb-2 text-base font-medium text-gray-900 ">Cargo</label>
                            <select id="cargo" required name="cargo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">Seleccionar</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="ods" class="block mb-2 text-base font-medium text-gray-900 ">Ods</label>
                            <input type="text" id="ods" name="ods"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="rol" class="block mb-2 text-base font-medium text-gray-900 ">Rol</label>
                            <select id="rol" required name="rol"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">Seleccionar</option>
                                <option value="Super_Admin">Super Administrador</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="RRHH">RRHH</option>
                                <option value="Personal">Personal</option>
                                <option value="Lector">Lector</option>
                            </select>
                        </div>
                    </div>
                </div>


                <button type="submit"
                    class="text-white bg-red-900 hover:bg-red-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar</button>
            </form>
        </div>
    </div>
@endsection
