<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-red-900 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <i class="fa-solid fa-bars text-2xl"></i>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-red-900">
        <ul class="space-y-2 font-medium">
            {{-- Boton de página de inicio --}}
            @if (Auth::check())
                @if (Auth::user()->rol === 'Super_Admin')
                    <li>
                        <a href="{{ route('inicio') }}"
                            class="flex items-center p-2 text-white rounded-lg hover:bg-red-700 hover:text-white group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Inicio</span>
                        </a>
                    </li>
                    {{-- Botón de página de registros => registrar producto, registrar usuario(empleado) --}}
                    <li>
                        <button id="toggle-registros" type="button"
                            class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                            aria-controls="dropdown-registros">
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Registrar</span>
                            <i class="fa-solid fa-angle-down text-xl text-white group-hover:text-white"></i>
                        </button>
                        <ul id="dropdown-registros" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('producto') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Producto</a>
                            </li>
                            <li>
                                <a href="{{ route('vehiculo') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Vehiculo</a>
                            </li>
                            <li>
                                <a href="{{ route('usuario') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Usuario</a>
                            </li>
                        </ul>
                    </li>
                    {{-- Botón de página de asignaciones => asignar equipo, retirar asignación --}}
                    <li>
                        <button id="toggle-asignacion" type="button"
                            class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                            aria-controls="dropdown-asignacion">
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Asignaciones</span>
                            <i class="fa-solid fa-angle-down text-xl text-white group-hover:text-white"></i>
                        </button>
                        <ul id="dropdown-asignacion" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('asignar') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Asignar
                                    Equipo</a>
                            </li>
                            <li>
                                <a href="{{ route('retirar') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Retirar
                                    Asignación</a>
                            </li>
                            <li>
                                <a href="{{ route('historial') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Historial
                                    Computo</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button id="toggle-dotacion" type="button"
                            class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                            aria-controls="dropdown-dotacion">
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Dotaciones</span>
                            <i class="fa-solid fa-angle-down text-xl text-white group-hover:text-white"></i>
                        </button>
                        <ul id="dropdown-dotacion" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('Dotacion-Registro') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Definir
                                    dotaciones</a>
                            </li>
                            <li>
                                <a href="{{ route('Dotacion') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Dotaciones
                                    asignadas</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <button id="toggle-alquiler" type="button"
                            class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                            aria-controls="dropdown-alquiler">
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Alquiler</span>
                            <i class="fa-solid fa-angle-down text-xl text-white group-hover:text-white"></i>
                        </button>
                        <ul id="dropdown-alquiler" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('alquiler') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Alquiler</a>
                            </li>
                            <li>
                                <a href="{{ route('alquiler.index') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Equipos
                                    Alquilados</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('categoria') }}"
                            class="flex items-center p-2 text-white rounded-lg hover:bg-red-700 hover:text-white group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Categoria</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('novedad') }}"
                            class="flex items-center p-2 text-white rounded-lg hover:bg-red-700 hover:text-white group">
                            <span class="flex-1 ms-3 whitespace-nowrap">Novedades</span>
                        </a>
                    </li>

                    <li>
                        <button id="toggle-lista" type="button"
                            class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                            aria-controls="dropdown-example">
                            <span class="flex-1 ms-3 text-left whitespace-nowrap">Lista</span>
                            <i class="fa-solid fa-angle-down text-xl text-white group-hover:text-white"></i>
                        </button>
                        <ul id="dropdown-lista" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('lis.asignados') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Asignados</a>
                            </li>
                            <li>
                                <a href="{{ route('lis.produc') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Productos</a>
                            </li>
                            <li>
                                <a href="{{ route('lis.vehiculos') }}"
                                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-700 hover:text-white">Vehiculos</a>
                            </li>
                        </ul>
                    </li>
                @else
                    @if (Auth::user()->rol === 'Personal')
                        <li>
                            <a href="{{ route('Dotacion') }}"
                                class="flex items-center p-2 text-white rounded-lg hover:bg-red-700 hover:text-white group">
                                <span class="flex-1 ms-3 whitespace-nowrap">Dotaciones asignadas</span>
                            </a>
                        </li>
                    @endif
                @endif
            @endif
            <li>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button
                        class="flex items-center w-full p-2 text-base text-white transition duration-75 rounded-lg group hover:bg-red-700 hover:text-white"
                        type="submit">
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">Salir</span>
                    </button>
                </form>
            </li>
        </ul>

    </div>
</aside>
