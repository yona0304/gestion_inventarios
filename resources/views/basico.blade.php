@extends('layouts.layout')

@section('title', 'Dotaciones Basica - INGICAT')

@section('content')

@section('content')
    <div class="p-4 sm:ml-64">
        @if (isset($user))
            <h2 class="text-xl font-semibold text-gray-700 border-b-2 border-gray-300 pb-2 mb-4">
                Estado de las dotaciones del usuario</h2>
            <div class="flex flex-wrap mt-3">
                <div class="w-full sm:w-1/2 p-4">
                    <p class="font-semibold text-gray-800 mb-1">Nombre:</p>
                    <span class="block bg-gray-100 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm">
                        {{ $user->nombres }}
                    </span>
                </div>

                <div class="w-full sm:w-1/2 p-4">
                    <p class="font-semibold text-gray-800 mb-1">Identificación:</p>
                    <span class="block bg-gray-100 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm">
                        {{ $user->identificacion }}
                    </span>
                </div>

                <div class="w-full sm:w-1/2 p-4">
                    <p class="font-semibold text-gray-800 mb-1">Cargo:</p>
                    <span class="block bg-gray-100 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm">
                        {{ $user->cargos->cargo }}
                    </span>
                </div>

                <div class="w-full sm:w-1/2 p-4">
                    <p class="font-semibold text-gray-800 mb-1">Ubicación:</p>
                    <span class="block bg-gray-100 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm">
                        {{ $user->ubicacion }}
                    </span>
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
    </div>
@endsection
