@extends('layouts.layout')

@section('title', 'Cambiar Clave')

@section('content')
    <div class="p-4 sm:ml-64">

        <div class="flex min-h-full flex-col justify-center px-6  lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Cambiar Clave</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form id="Cambio_contrase" class="space-y-6" action="{{ route('cambio.update') }}" method="POST">
                    @csrf
                    <div>
                        <label for="contra_actual" class="block text-sm font-medium leading-6 text-gray-900">Ingresar
                            clave actual <strong>*</strong></label>
                        <div class="mt-2">
                            <input name="contra_actual" type="password" id="contra_actual"
                                placeholder="Ingrese su contraseña actual" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="nueva_contrase" class="block text-sm font-medium leading-6 text-gray-900">Ingresar nueva
                            clave <strong>*</strong></label>
                        <div class="mt-2">
                            <input name="nueva_contrase" type="password" id="nueva_contrase"
                                placeholder="Ingrese su nueva contraseña" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="nueva_contrase_confirmation"
                            class="block text-sm font-medium leading-6 text-gray-900">Confirmar nueva clave
                            <strong>*</strong></label>
                        <div class="mt-2">
                            <input name="nueva_contrase_confirmation" type="password" id="nueva_contrase_confirmation"
                                placeholder="Confirme su nueva contraseña" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="mostrar_contrase" name="mostrar_contrase" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300">
                        <label for="mostrar_contrase" class="ml-3 min-w-0 flex-1 text-gray-500">Mostrar Clave</label>
                    </div>

                    <div>
                        <button type="submit" id="submit-Btn"
                            class="flex w-full justify-center rounded-md bg-blue-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
