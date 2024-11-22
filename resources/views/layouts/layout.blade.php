<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/ingicat.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/alquilerImport.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{-- @vite('resources/css/app.css') --}}
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .disponible {
            color: green;
        }

        .asignado {
            color: orange;
        }

        .devolucion {
            color: rgb(212, 35, 35)
        }

        .retirado {
            color: rgb(212, 35, 35)
        }

        .inactivo {
            color: orange;
        }

        .mantenimiento {
            color: orange;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    @yield('content')

    <!--script necesarios-->
    <script src="{{ asset('js/devolucion.js') }}"></script>
    <script src="{{ asset('js/alquiler.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/usuario.js') }}"></script>
    <script src="{{ asset('js/asignar.js') }}"></script>
    <script src="{{ asset('js/historial.js') }}"></script>
    <script src="{{ asset('js/vehiculo.js') }}"></script>
    <script src="{{ asset('js/categoria.js') }}"></script>
    <script src="{{ asset('js/lisProducto.js') }}"></script>
    <script src="{{ asset('js/lisAsignacion.js') }}"></script>
<<<<<<< HEAD
    <script src="{{ asset('js/historial.js') }}"></script>
    <script src="{{asset('js/novedades.js')}}"></script>
=======
>>>>>>> 00d3edbc60a8c4ecb4503d2c494f4e4bf9b815e1
</body>

</html>
