<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/ingicat.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Bienvenido</title>
    <style>
        /* Estilo para el fondo borroso */
        .blur-background {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Oscuro con opacidad */
            z-index: 40; /* Debajo del modal pero sobre el contenido */
            display: none; /* Oculto por defecto */
        }
    </style>
</head>

<body class="h-screen flex items-center justify-center bg-red-900">
    <div class="grid gap-4 mb-6 md:grid-cols-2" id="content">

        <button id="mostrar"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-[0_0_15px_rgba(255,255,255,0.6)]">
            <img src="{{ asset('images/ingicat.png') }}" alt="logo ingicat" class="mb-4">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ingresar al sistema</h5>
        </button>

        <button
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-[0_0_15px_rgba(255,255,255,0.6)]">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Consultar Paz y Salvo</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Aqui podras consultar acerca de los equipos que te
                han sido asignados, como tambien el estado de tu asignación.</p>
        </button>

    </div>

    <div id="overlay" class="overlay"></div>
    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Iniciar sesion en nuestra plataforma
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="#" method="POST">
                        @csrf
                        <div>
                            <label for="correo" class="block mb-2 text-sm font-medium text-gray-900">Ingresar correo
                                electrónico</label>
                            <input type="email" name="correo" id="correo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                placeholder="example@ingicat.com" required />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Ingresar
                                contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="ver_contraseña" type="checkbox" value=""
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50" required />
                                </div>
                                <label for="ver_contraseña" class="ms-2 text-sm font-medium text-gray-900">Ver
                                    contraseña</label>
                            </div>
                            <a href="#" class="text-sm text-blue-700 hover:underline">¿Has olvidado tu
                                contraseña?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-red-900 hover:bg-red-700 focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bienvenido.js') }}"></script>
</body>

</html>
