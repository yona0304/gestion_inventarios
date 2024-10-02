<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/ingicat.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('layouts.header')

    @yield('content')

    <!--script necesarios-->
    <script src="{{ asset('js/header.js') }}"></script>
</body>

</html>
