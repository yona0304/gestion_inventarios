@extends('layouts.layout')

@section('title', 'Registrar Usuario')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="container mt-10">
            <form id="UsuaEnvi" action="{{ route('usuario.store') }}" method="POST">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <h1 class="text-center font-medium text-2xl text-gray-900">Registrar Personal</h1>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="identificacion" class="block mb-2 text-base font-medium text-gray-900 ">ID del
                                Profesional <span class="text-red-700">*</span></label>
                            <input type="number" id="identificacion" name="identificacion"
                                placeholder="Documento del profesional"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="nombre" class="block mb-2 text-base font-medium text-gray-900 ">Nombre completo
                                <span class="text-red-700">*</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="xxxxxxxx xxxxxxx xxxxxxx..."
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="correo" class="block mb-2 text-base font-medium text-gray-900 ">Correo <span
                                    class="text-red-700">*</span></label>
                            <input type="email" id="correo" name="correo" placeholder="example@example.com"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="cargo" class="block mb-2 text-base font-medium text-gray-900 ">Cargo <span class="text-red-700">*</span></label>
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
                            <label for="ubicacion" class="block mb-2 text-base font-medium text-gray-900 ">Ubicación <span class="text-red-700">*</span></label>
                            <select id="ubicacion" required name="ubicacion"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <option value="">Seleccionar</option>
                                <option value="BARRANCABERMEJA">BARRANCABERMEJA</option>
                                <option value="BOGOTÁ">BOGOTÁ</option>
                                <option value="VILLAVICENCIO">VILLAVICENCIO</option>
                            </select>
                        </div>
                        <div>
                            <label for="rol" class="block mb-2 text-base font-medium text-gray-900 ">Rol <span class="text-red-700">*</span></label>
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

                    {{-- <div class="grid md:grid-cols-2 md:gap-6">
                        <div>
                            <label for="ods" class="block mb-2 text-base font-medium text-gray-900 ">Ods</label>
                            <input type="text" id="ods" name="ods" value="No necesario"
                                placeholder="colocar 'No necesario'"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="rol" class="block mb-2 text-base font-medium text-gray-900 ">Rol <span class="text-red-700">*</span></label>
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
                    </div> --}}
                </div>


                <button type="submit"
                    class="text-white bg-blue-900 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrar</button>
            </form>
        </div>
    </div>
@endsection
