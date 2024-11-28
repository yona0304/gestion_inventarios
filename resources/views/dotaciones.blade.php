@extends('layouts.layout')

@section('title', 'Dotaciones - INGICAT')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="max-w-sm mx-auto">
            <form action="{{ route('Dotacion.Reg') }}" id="dotaForm" method="POST">
                @csrf
                <label for="user" class="block mb-2 text-xl font-medium text-gray-900">Identificacion</label>
                <input type="user" id="user" name="user"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
            focus:border-blue-500 block w-full p-2.5">
                <button type="submit"
                    class="mt-4 w-full bg-red-700 text-white font-semibold rounded-lg p-2 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-blue-400">Enviar</button>
            </form>
        </div>
        @if (isset($user))
            <div class="flex flex-wrap mt-3">
                <div class="w-full sm:w-1/2 p-2">
                    <p class="font-semibold text-gray-700">Nombre:</p>
                    <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->nombres }}</span>
                </div>

                <div class="w-full sm:w-1/2 p-2">
                    <p class="font-semibold text-gray-700">Identificación:</p>
                    <span
                        class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->identificacion }}</span>
                </div>

                <div class="w-full sm:w-1/2 p-2">
                    <p class="font-semibold text-gray-700">Cargo:</p>
                    <span
                        class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->cargos->cargo }}</span>
                </div>

                <div class="w-full sm:w-1/2 p-2">
                    <p class="font-semibold text-gray-700">Ubicación:</p>
                    <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->ubicacion }}</span>
                </div>
            </div>
        @endif

        <div>
            @if (isset($dotaAsignada))
                <h2 class="text-lg font-bold text-gray-700 mb-6 border-b pb-2">Asignaciones que coinciden con las dotaciones
                    requeridas</h2>
                <ul class="list-disc pl-6 space-y-4 mb-6">
                    @foreach ($nombres as $asignacion)
                        <li class="bg-gray-100 p-4 rounded-md shadow-sm text-gray-800 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold text-gray-700">Dotación asignada:</span>
                                <span class="text-sm text-gray-900">{{ $asignacion['categoria'] }}</span>
                                <span class="font-semibold text-gray-700">Descripcion:</span>
                                <span class="text-sm text-gray-900">{{ $asignacion['producto1'] }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            @if (isset($dotaFaltantes))
                <h2 class="text-lg font-bold text-gray-700 mb-6 border-b pb-2">Dotaciones que le faltan al usuario</h2>
                <ul class="list-disc pl-6 space-y-4 mb-6">
                    @foreach ($dotaFaltantes as $dotacion)
                        <li class="bg-gray-100 p-4 rounded-md shadow-sm text-gray-800 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold text-gray-700">Dotacion faltante:</span>
                                <span class="text-sm text-gray-900">{{ $dotacion->nombre_categoria }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if (isset($listo))
            <p>Las dotaciones requeridas son:</p>
            @foreach ($listo as $Dota)
                <span>{{ $Dota }}</span><br>
            @endforeach
        @endif
        @if (isset($faltas))
        <button id="show-users" class="bg-red-700 text-white font-semibold py-2 px-4 mt-14 rounded-lg shadow-md hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Mostrar lista de usuarios con dotaciones incompletas
        </button>
        <div id="hidden" class="hidden">
            <button id="hide-users" class="bg-red-700 text-white font-semibold py-2 px-4 mt-14 rounded-lg shadow-md hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Ocultar lista
            </button>
            <br>
            <h2 class="text-2xl font-bold text-gray-800 px-4 py-2 rounded-lg ">
                Usuarios con dotacion incompleta
            </h2>
            <br>
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-red-700">
                        <th class="px-4 py-2 text-left text-sm font-medium text-white">Nombre</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-white">Identificación</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-white">Cargo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-white">Ubicacion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faltas as $falta)
                        <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $falta->nombres }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $falta->identificacion }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $falta->cargos->cargo }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $falta->ubicacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <script>
        const showButton = document.getElementById('show-users');
        const hiddenDiv = document.getElementById('hidden');
        const hideButton = document.getElementById('hide-users');

        // Mostrar la lista y ocultar el botón "Mostrar"
        showButton.addEventListener('click', function () {
            hiddenDiv.classList.remove('hidden');
            showButton.classList.add('hidden');
        });

        // Ocultar la lista y mostrar el botón "Mostrar"
        hideButton.addEventListener('click', function () {
            hiddenDiv.classList.add('hidden');
            showButton.classList.remove('hidden');
        });
    </script>
@endsection
