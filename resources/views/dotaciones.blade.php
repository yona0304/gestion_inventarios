@extends('layouts.layout')

@section('title', 'Inicio - INGICAT')

@section('content')
<div class="p-4 sm:ml-64">
<div class="max-w-sm mx-auto">
    <form action="{{ route('Dotacion.Reg') }}" id="dotaForm" method="POST">
        @csrf
            <label for="user" class="block mb-2 text-xl font-medium text-gray-900">Identificacion</label>
            <input type="user" id="user" name="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
            focus:border-blue-500 block w-full p-2.5">
            <button type="submit" class="mt-4 w-full bg-red-700 text-white font-semibold rounded-lg p-2 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-blue-400">Enviar</button>
    </form>
</div>
@if(isset($user))
    <div class="flex flex-wrap mt-3">
        <div class="w-full sm:w-1/2 p-2">
            <p class="font-semibold text-gray-700">Nombre:</p>
            <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->nombres }}</span>
        </div>

        <div class="w-full sm:w-1/2 p-2">
            <p class="font-semibold text-gray-700">Identificación:</p>
            <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->identificacion }}</span>
        </div>

        <div class="w-full sm:w-1/2 p-2">
            <p class="font-semibold text-gray-700">Cargo:</p>
            <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->cargo_id }}</span>
        </div>

        <div class="w-full sm:w-1/2 p-2">
            <p class="font-semibold text-gray-700">Ubicación:</p>
            <span class="block border border-gray-300 rounded-lg p-2 text-gray-600">{{ $user->ubicacion }}</span>
        </div>
    </div>
@endif

<div>
    @if (isset($dotaAsignada))
        <h2 class="text-lg font-bold text-gray-700 mb-6 border-b pb-2">Asignaciones que coinciden con las dotaciones requeridas</h2>
        <ul class="list-disc pl-6 space-y-4 mb-6">
            @foreach($nombres as $asignacion)
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
                @foreach($dotaFaltantes as $dotacion)

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
</div>
@endsection
